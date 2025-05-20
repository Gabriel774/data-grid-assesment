export function filterObjectValues(object: object): object {
    return Object.fromEntries(
        Object.entries(object).filter(([_, v]) => v != null)
    );
}

export function getCleanUrl(url: string): string {
    const urlObject = new URL(url);

    return urlObject.origin + urlObject.pathname;
}