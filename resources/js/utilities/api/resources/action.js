import BaseResource from './../baseresource';

export default class extends BaseResource{

    index() {
        return this.request('get', '/action');
    }

}
