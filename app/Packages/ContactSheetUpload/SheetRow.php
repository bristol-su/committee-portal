<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 07/02/19
 * Time: 16:45
 */

namespace App\Packages\ContactSheetUpload;


use App\Jobs\SaveStudentInCache;
use App\Modules\BaseModule\ModuleConfiguration;
use App\Modules\ExitingTreasurer\Entities\Document;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SheetRow extends BaseSheetRow
{

    protected $unionCloudStudent;

    public static function getHeaders()
    {
        return [
            'Group Control ID',
            'Group Name',
            'Group Email',
            'Group UnionCloud ID',
            'Role',
            'Position Title',
            'Active Year',
            'UnionCloud UID',
            'Forename',
            'Surname',
            'Student ID',
            'Email',
            'Financial Documents Uploaded',
            '(Irrelevant) #WeAreBristol Strategic Plan',
            'Charitable Giving',
            '(Irrelevant) #WeAreBristol Budget',
            '(Irrelevant) #WeAreBristol Tier Selection',
            '(Irrelevant) #WeAreBristol Executive Summary',
            '(Irrelevant) Reaffiliation Statistics',
            '(Irrelevant) #WeAreBristol Further Information',
            'President Handover',
            '(Irrelevant) #WeAreBristol Presentation',
            'Political Activity',
            'Exiting Treasurer Sign Off',
            'Key Group Info',
            'Committee Details',
            'Main Contacts',
            'Task Allocation',
            'Constitution',
            'Risk Assessment',
            'Equipment List',
            'Incoming Treasurer Training',
            'GDPR',
            'External Accounts',
            'Strategic Plan',
            'Safeguarding',
            'Budget',
            'NGB',
            'Libel & Defamation'
        ];
    }

    public function generateData()
    {
        $unionCloudStudent = $this->getUnionCloudStudent($this->student->uc_uid);
        if ($unionCloudStudent === false) {
            return false;
        }

        $progress = Cache::remember('GenerateProgressSheet.groupprogress.'.$this->group->id, 45, function() {
            $rawModules = collect(\Nwidart\Modules\Facades\Module::getOrdered())->filter(function($module) {
                return $module->active === 1;
            });

            $configurations = new \Illuminate\Support\Collection();
            foreach ($rawModules as $rawModule) {
                if (!class_exists($rawModule->dynamic_configuration)) {
                    throw new \Exception('Please define a dynamic_configuration property in module '.$rawModule->getName());
                }

                $moduleConfig = (new $rawModule->dynamic_configuration)->getConfiguration();
                $moduleConfig['rawModule'] = $rawModule;
                $configurations->push($moduleConfig);
            }

            $progress = [];
            $configurations->each(function($configuration) use (&$progress){

                /** @var ModuleConfiguration $config */
                $config = new $configuration['rawModule']->dynamic_configuration;

                $config->setGroup($this->group);
                $completed = $config->isComplete($config->getGroup());
                $progress[$config->alias()] = ($completed?'Complete':'Incomplete');

            });

            return $progress;
        });

        $this->unionCloudStudent = $unionCloudStudent;

        $this->elements = array_merge([
            'group_id' => $this->group->id,
            'group_name' => $this->group->name,
            'group_email' => $this->group->email,
            'group_unioncloud_id' => $this->group->unioncloud_id,
            'role' => $this->position->name,
            'position_title' => ($this->positionStudentGroup->position_name === '' ? $this->position->name : $this->positionStudentGroup->position_name),
            'committee_year' => $this->getAcademicYear($this->positionStudentGroup->committee_year),
            'uid' => $this->student->uc_uid,
            'forename' => $this->unionCloudStudent->forename,
            'surname' => $this->unionCloudStudent->surname,
            'student_id' => $this->unionCloudStudent->id,
            'email' => $this->unionCloudStudent->email,
            'financialdocsuploaded' => ((Document::where([
                'group_id' => $this->group->id,
                'uploaded' => true,
                'year' => getReaffiliationYear()
            ])->count() >= 2)?'Uploaded':'Not Uploaded'),
        ], $progress);
        return true;
    }

    private function getUnionCloudStudent($uid)
    {

        if (Cache::has('command:contactsheet:unioncloud:uid.' . $uid)) {
            return json_decode(Cache::get('command:contactsheet:unioncloud:uid.' . $uid));
        }
        // Dispatch job to collect information and save it in the cache
        SaveStudentInCache::dispatch($uid);

        return false;
    }

    public function getAcademicYear($year)
    {
        return $year.'/'.substr(($year+1), 2, 2);
    }
}