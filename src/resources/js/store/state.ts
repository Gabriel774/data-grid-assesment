export const state: stateType = {
    data: [],
    nextPageUrl: undefined,
    previousPageUrl: undefined,
    currentPageUrl: '',
    filters: [],
    activeFilters: {},
    pendingFilters: {},
    loading: true,
    currentPage: 1
}

export type stateType = {
    data: object[],
    nextPageUrl?: string,
    previousPageUrl?: string,
    filters: [],
    currentPageUrl: string,
    activeFilters: object,
    pendingFilters: object,
    loading: boolean,
    currentPage: number
};