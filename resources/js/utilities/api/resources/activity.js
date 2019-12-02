import BaseResource from './../baseresource';

export default class extends BaseResource{

    create(attributes) {
        return this.request('post', '/activity', attributes);
    }

    progress(activityId) {
        return this.request('get', '/activity/' + activityId + '/progress');
    }
}
