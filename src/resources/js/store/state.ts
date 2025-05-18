export const state: stateType = {
    data: [],
    nextPageUrl: undefined,
    previousPageUrl: undefined,
    currentPageUrl: '',
    activeFilters: {},
    pendingFilters: {},
    loading: true,
    currentPage: 1
}

export type stateType = {
    data: object[],
    nextPageUrl?: string,
    previousPageUrl?: string,
    currentPageUrl: string,
    activeFilters: object,
    pendingFilters: object,
    loading: boolean,
    currentPage: number
};