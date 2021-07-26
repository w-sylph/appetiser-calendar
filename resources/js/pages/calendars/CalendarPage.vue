<template>
    <div class="container bg-light mt-3">
        <div class="card">
            <div class="card-header bg-white mt-3">
                <h5>Calendar</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-5">
                        <calendar-form
                            @success="fetch"
                            @load="load"
                        />
                    </div>
                    <div class="col-12 col-sm-7">
                        <calendar
                            :month="month"
                            :year="year"
                            :events="events"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ResponseMixin from 'Mixins/response.js';
import CalendarForm from './CalendarForm.vue';
import Calendar from './Calendar.vue';

export default {
    name: 'calendar-page',

    components: {
        CalendarForm,
        Calendar
    },

    mixins: [ ResponseMixin ],

    data: () => ({
        loading: false,
        month: null,
        year: null,
        events: []
    }),

    mounted() {
        this.fetch();
    },

    methods: {
        fetch() {
            this.load(true);

            let params = {
                month: this.month,
                year: this.year
            };

            axios.post(this.routes['calendars.fetch'], params)
                .then(response => {
                    let data = response.data;
                    this.events = data.events;
                }).catch(error => {
                    console.log(error);
                    this.parseError(error);
                }).then(() => {
                    this.load(false);
                });
        },

        load(value) {
            this.loading = value;
        }
    }
};
</script>