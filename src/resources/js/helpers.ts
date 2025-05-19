export function filterObjectValues(object: object): object {
    return Object.fromEntries(
        Object.entries(object).filter(([_, v]) => v != null)
    );
}