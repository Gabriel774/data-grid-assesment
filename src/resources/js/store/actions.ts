import { filterObjectValues, getCleanUrl } from "@/helpers";

export default {
    async fetchData(resetPage: boolean = false): Promise<void> {
        this.loading = true;

        const url = new URL(this.currentPageUrl);

        Object.entries(this.activeFilters).forEach(([key, value]) => {
            url.searchParams.set(key, value);
        });

        if (resetPage) {
            url.searchParams.set('page', '1');
        }

        const response = (await ((await fetch(url)).json()));

        this.data = response.data;

        this.previousPageUrl = response.links.prev;

        this.nextPageUrl = response.links.next;

        this.currentPage = response.meta.current_page;

        this.cacheData();

        this.loading = false;
    },
    setCurrentPageUrl(url: string): void {
        this.currentPageUrl = url;
    },
    setPendingFilters(key: string, value?: string): void {
        const pendingFilters = filterObjectValues({ ...this.pendingFilters, [key]: value?.length ? value : null });

        this.pendingFilters = { ...pendingFilters };
    },
    setActiveFilters(key: string, value?: string) {
        const activeFilters = filterObjectValues({ ...this.activeFilters, [key]: value?.length ? value : null })

        this.activeFilters = { ...activeFilters };

        this.pendingFilters = { ...activeFilters };

        this.fetchData(true);

        this.setCurrentPageUrl(getCleanUrl(this.currentPageUrl));
    },
    fetchNextPage(): void {
        this.setCurrentPageUrl(this.nextPageUrl);

        this.fetchData();
    },
    fetchPreviousPage(): void {
        this.setCurrentPageUrl(this.previousPageUrl);

        this.fetchData();
    },
    applyPendingFilters(): void {
        this.activeFilters = { ...this.pendingFilters };

        this.fetchData(true);

        this.setCurrentPageUrl(getCleanUrl(this.currentPageUrl));
    },
    setFilters(filters: []): void {
        this.filters = filters;
    },
    setId(id: string): void {
        this.id = id;
    },
    getValueWithStoreId(value: string): string {
        return `${value}_${this.id}`
    },
    cacheData(): void {
        this.setItemInLocalStorage('pendingFilters', JSON.stringify(this.pendingFilters));
        this.setItemInLocalStorage('activeFilters', JSON.stringify(this.activeFilters));
        this.setItemInLocalStorage('currentPage', this.currentPage);
        this.setItemInLocalStorage('currentPageUrl', this.currentPageUrl);
        this.setItemInLocalStorage('nextPageUrl', this.nextPageUrl);
        this.setItemInLocalStorage('previousPageUrl', this.previousPageUrl);
    },
    mapDatafromCache(): void {
        this.pendingFilters = { ...JSON.parse(this.getItemInLocalStorage('pendingFilters') || '{}') };
        this.activeFilters = { ...JSON.parse(this.getItemInLocalStorage('activeFilters') || '{}') };
        this.currentPage = this.getItemInLocalStorage('currentPage');
        this.currentPageUrl = this.getItemInLocalStorage('currentPageUrl');
        this.nextPageUrl = this.getItemInLocalStorage('nextPageUrl');
        this.previousPageUrl = this.getItemInLocalStorage('previousPageUrl');
    },
    setItemInLocalStorage(key: string, value: string): void {
        localStorage.setItem(this.getValueWithStoreId(key), value);
    },
    getItemInLocalStorage(key: string): string | null {
        return localStorage.getItem(this.getValueWithStoreId(key))
    },
    resetFilters(): void {
        this.pendingFilters = {};
        this.activeFilters = {};
        this.currentPage = 1;
        this.currentPageUrl = getCleanUrl(this.currentPageUrl);
        this.nextPageUrl = undefined;
        this.previousPageUrl = undefined;

        this.fetchData();
    }
}

