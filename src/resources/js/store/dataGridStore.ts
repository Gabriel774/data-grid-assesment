import { defineStore } from 'pinia';
import { state, stateType } from './state';
import actions from './actions';

export default defineStore('dataGrid', {
    state: (): stateType => ({ ...state }),
    actions
});
