export const state: stateType = {
    data: [],
    nextPageUrl: undefined,
    previousPageUrl: undefined,
    getDataRoute: '',
    activeFilters: [],
    pendingFilters: [],
    loading: true,
}

export type stateType = {
    data: object[],
    nextPageUrl?: string,
    previousPageUrl?: string,
    getDataRoute: string,
    activeFilters: object[],
    pendingFilters: object[],
    loading: boolean
};