<template>
    <calendar-page />
</template>

<script>
import ResponseMixin from 'Mixins/response.js';

import CalendarPage from './calendars/CalendarPage.vue';

export default {
    name: 'app',

    components: {
        CalendarPage
    },

    mixins: [ ResponseMixin ],

    props: {
        routeUrl: {
            default: null,
            type: String
        }
    },

    created() {
        //
    },

    methods: {
        //
    }
};
</script>