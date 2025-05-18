import { defineStore } from 'pinia';
import { state, stateType } from './state';

export default defineStore('dataGrid', {
    state: (): stateType => ({ ...state }),
    actions: {
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

            this.loading = false;
        },
        setCurrentPageUrl(url: string): void {
            this.currentPageUrl = url;
        },
        setPendingFilters(key: string, value: string): void {
            this.pendingFilters = { ...this.pendingFilters, [key]: value }
        },
        setActiveFilters() {

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
        }
    }
});
