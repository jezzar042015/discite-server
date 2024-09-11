export async function get(url: string) {
    try {
        const resp = await fetch(url);
        if (!resp.ok) {
            throw new Error(`Response status: ${resp.status}`);
        }
        return resp;

    } catch (error: unknown) {
        if (error instanceof Error) {
            console.error(error.message);
        } else {
            console.error("An unknown error occured");
        }
    }
}

export async function put(url:string, body: string) {
    try {
        const resp = await fetch(url, {
            method: 'put',
            body: body,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })

        if (resp.ok) return resp;

    } catch (error) {
        if (error instanceof Error) {
            console.error(error.message);
        } else {
            console.error("An unknown error occured while attempting to update course");
        }
    }
}

export async function post(url:string, body: string) {
    try {
        const resp = await fetch(url, {
            method: 'post',
            body: body,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })

        if (resp.ok) return resp;

    } catch (error) {
        if (error instanceof Error) {
            console.error(error.message);
        } else {
            console.error("An unknown error occured while attempting to update course");
        }
    }
}