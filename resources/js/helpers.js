export function registerEventListener(name, callback) {
    document.addEventListener(name, callback);
}

export function emmitEvent(name, data) {
    document.dispatchEvent(
        new CustomEvent(name, {
            detail: data,
        })
    );
}
