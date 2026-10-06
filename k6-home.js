import http from 'k6/http';

const concurrent_users = Number(__ENV.CONCURRENT_USERS || 1);

const base_url = __ENV.BASE_URL || 'http://127.0.0.1:8000';

export const options = {
    discardResponseBodies: true,
    scenarios: {
        home: {
            executor: 'per-vu-iterations',
            vus: concurrent_users,
            iterations: 5,
        },
    },
};

export default function () {
    http.get(`${base_url}/?concurrent_users=${concurrent_users}`, {
        headers: {Accept: 'application/json'},
        timeout: '10m',
    });
}
