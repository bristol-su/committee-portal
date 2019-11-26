import BaseResource from './../baseresource';

export default class extends BaseResource{

    all() {
        return this.request('get', '/user');
    }

}
