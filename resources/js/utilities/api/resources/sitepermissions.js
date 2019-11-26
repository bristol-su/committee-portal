import BaseResource from './../baseresource';

export default class extends BaseResource{

    all() {
        return this.request('get', '/site-permission');
    }

    get(ability) {
        return this.request('get', '/site-permission/' + ability);
    }

    usersWith(ability) {
        return this.request('get', '/site-permission/' + ability + '/user');
    }

    giveUserPermissionTo(userId, ability) {
        return this.request('post', '/site-permission/' + ability + '/user/' + userId);
    }

    revokeUserFrom(userId, ability) {
        return this.request('delete', '/site-permission/' + ability + '/user/' + userId);
    }
}
