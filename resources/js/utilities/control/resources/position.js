import BaseResource from './../baseresource';

export default class extends BaseResource{

    getById(id) {
        return this.request('get', '/position/' + id);
    }

}
