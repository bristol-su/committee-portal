import Activity from './resources/activity';
import Logic from "./resources/logic";
import Modules from './resources/modules';
import Settings from './resources/settings';
import Permissions from './resources/permissions'
import Filters from './resources/filters';
import FilterInstances from './resources/filterinstances';
import ModuleInstances from './resources/moduleinstances';
import Me from './resources/me';
import Action from './resources/action';
import ActionInstance from './resources/actionInstance';
import ActionInstanceField from './resources/actionInstanceField';
import Group from './resources/group';
import Role from './resources/role';

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

    action() {
        return new Action(this._http);
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

    settings() {
        return new Settings(this._http);
    }

    permissions() {
        return new Permissions(this._http);
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
}
