import BaseResource from './../baseresource';

export default class extends BaseResource{

    getBelongingToActivity(id) {
        return this.request('get', '/activity/' + id + '/module_instances');
    }

}
