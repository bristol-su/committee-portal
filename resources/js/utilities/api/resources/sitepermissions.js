import BaseResource from './../baseresource';

export default class extends BaseResource{

    all() {
        return this.request('get', '/site_permission');
    }

    get(ability) {
        return this.request('get', '/site_permission/' + ability);
    }
}
