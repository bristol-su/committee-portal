import Activity from './resources/activity';
import Logic from "./resources/logic";
import Modules from './resources/modules';
import ModuleInstanceSettings from './resources/moduleInstanceSettings';
import ModuleInstancePermissions from './resources/moduleinstancepermissions';
import Filters from './resources/filters';
import FilterInstances from './resources/filterinstances';
import ModuleInstances from './resources/moduleinstances';
import Me from './resources/me';
import Action from './resources/action';
import ActionInstance from './resources/actionInstance';
import ActionInstanceField from './resources/actionInstanceField';
import Group from './resources/group';
import Role from './resources/role';
import SitePermissions from './resources/sitepermissions';
import CompletionConditions from './resources/completionconditions';
import ActivityInstance from './resources/activityinstance';
import Connector from './resources/connector';
import Connection from './resources/connection';
import ModuleInstanceServices from './resources/moduleinstanceservices';

// TODO Implement Cache
export default class {
    constructor(baseUrl, axios) {
        this._http = axios.create({
            baseURL: baseUrl,
            withCredentials: true,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
    }

    // TODO Does this always work?
    asRole(roleId) {
        this._http.interceptors.request.use(function(config) {
            config.params['role_id'] = roleId;
        }, function (error) {
            return Promise.reject(error);
        });
        return this;
    }

    action() {
        return new Action(this._http);
    }

    connector() {
        return new Connector(this._http);
    }

    connection() {
        return new Connection(this._http);
    }

    completionConditions() {
        return new CompletionConditions(this._http);
    }
    actionInstance() {
        return new ActionInstance(this._http);
    }

    actionInstanceField() {
        return new ActionInstanceField(this._http);
    }

    activity() {
        return new Activity(this._http);
    }

    logic() {
        return new Logic(this._http);
    }

    modules() {
        return new Modules(this._http);
    }

    moduleInstanceSettings() {
        return new ModuleInstanceSettings(this._http);
    }

    activityInstance() {
        return new ActivityInstance(this._http);
    }

    moduleInstancePermissions() {
        return new ModuleInstancePermissions(this._http);
    }

    sitePermissions() {
        return new SitePermissions(this._http);
    }

    filters() {
        return new Filters(this._http);
    }

    filterInstance() {
        return new FilterInstances(this._http);
    }

    moduleInstances() {
        return new ModuleInstances(this._http);
    }

    me() {
        return new Me(this._http);
    }

    group() {
        return new Group(this._http);
    }

    role() {
        return new Role(this._http);
    }

    moduleInstanceServices() {
        return new ModuleInstanceServices(this._http);
    }
}
