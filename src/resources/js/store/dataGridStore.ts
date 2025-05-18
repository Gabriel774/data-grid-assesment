import { defineStore } from 'pinia';
import { state, stateType } from './state';

export default defineStore('dataGrid', {
    state: (): stateType => ({ ...state }),
    getters: {
        getData: (state: stateType) => state.data
    },
    actions: {
        async fetchData(url: string) {
            this.loading = true;

            const response = (await ((await fetch(url)).json()));

            this.data = response.data;

            this.previousPageUrl = response.links.prev;

            this.nextPageUrl = response.links.next;

            this.loading = false;
        },
        setGetDataRoute(url: string) {
            this.getDataRoute = url;
        },
        setPendingFilters() {

        },
        setActiveFilters() {

        },
        fetchNextPage() {
            this.fetchData(this.nextPageUrl)
        },
        fetchPreviousPage() {
            this.fetchData(this.previousPageUrl)
        },
    }
});