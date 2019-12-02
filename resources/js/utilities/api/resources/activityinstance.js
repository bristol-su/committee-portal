import BaseResource from './../baseresource';

export default class extends BaseResource{

    create(attributes) {
        return this.request('post', '/activity-instance', attributes);
    }

    
    evaluation(activityInstanceId) {
        return this.request('get', '/activity/' + activityInstanceId + '/evaluation');
    }


}
