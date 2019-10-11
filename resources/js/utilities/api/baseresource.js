export default class {

    constructor(client) {
        this._client = client;
    }

    request(method, url, body, params)
    {
        return this._client.request({
            url: url,
            method: method,
            data: body,
            params: params,
        })
    }
}
