import User from './resources/user';
import Group from './resources/group';
import Position from './resources/position';

// TODO Implement Cache
export default class {
    constructor(baseUrl, axios) {
        this._http = axios.create({
            baseURL: baseUrl,
            withCredentials: true,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
    }

    user() {
        return new User(this._http);
    }

    group() {
        return new Group(this._http);
    }

    position() {
        return new Position(this._http);
    }
}
