import BaseResource from './../baseresource';

export default class extends BaseResource{


    create(attributes) {
        return this.request('post', '/filter-instances', attributes);
    }

}
