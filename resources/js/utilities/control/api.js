import User from './resources/user';

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
}
