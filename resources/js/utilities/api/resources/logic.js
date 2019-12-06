import BaseResource from './../baseresource';

export default class extends BaseResource{

    get(id) {
        return this.request('get', '/logic/' + id);
    }

    all() {
        return this.request('get', '/logic');
    }

    create(attributes) {
        return this.request('post',  '/logic', attributes);
    }

    audience(logicId) {
        return this.request('get', '/logic/' + logicId + '/audience');
    }



    userAudience(logicId) {
        return this.request('get', '/logic/' + logicId + '/audience/user');
    }

    groupAudience(logicId) {
        return this.request('get', '/logic/' + logicId + '/audience/group');
    }

    roleAudience(logicId) {
        return this.request('get', '/logic/' + logicId + '/audience/role');
    }
}
