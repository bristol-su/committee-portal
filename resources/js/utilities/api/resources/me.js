import BaseResource from './../baseresource';

export default class extends BaseResource{

    roles() {
        return this.request('get', '/me/roles');
    }

}
