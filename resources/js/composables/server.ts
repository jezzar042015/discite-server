const server = {
    token: '' as string | null,
}

export async function get(url: string) {
    retriveToken()
    try {
        const resp = await fetch(url, {
            method: 'get',
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': server.token,
            }            
        });
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
    retriveToken()
    try {
        const resp = await fetch(url, {
            method: 'put',
            body: body,
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': server.token,
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
    retriveToken();
    try {
        const resp = await fetch(url, {
            method: 'post',
            body: body,
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': server.token,
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

function retriveToken() {
    if (!server.token) {
        const target = document.querySelector('meta[name="csrf-token"]') as HTMLElement;
        server.token = target ? target.getAttribute("content") : null;
    }
    if (!server.token) {
        console.error('CSRF token not found or invalid.');
    }
}