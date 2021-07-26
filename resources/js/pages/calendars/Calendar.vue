<template>
    <div class="row">
        <div class="col-12">
            <h3>
                {{ header }}
            </h3>
            <ul class="list-group">
                <calendar-date
                    v-for="(date, index) in dates"
                    :key="`date-${index}`"
                    :value="date"
                    :events="events"
                />
            </ul>
        </div>
    </div>
</template>

<script>
import CalendarDate from './CalendarDate.vue';
export default {
    name: 'calendar',

    components: {
        CalendarDate
    },

    props: {
        month: {
            default: null,
            type: Number
        },

        year: {
            default: null,
            type: Number
        },

        events: {
            default: () => {
                return new Array;
            },
            type: Array
        }
    },

    data: () => ({
        dates: []
    }),

    computed: {
        header() {
            let date = this.getDate();

            let year = date.getFullYear();
            let month = (date.getMonth() + 1).toString().padStart(2, '0');
            let day = date.getDate().toString().padStart(2, '0');

            return moment(`${year}-${month}-${day}`).format('MMM YYYY');
        }
    },

    watch: {
        month() {
            this.generateDates();
        },

        year() {
            this.generateDates();
        }
    },

    created() {
        this.generateDates();
    },

    mounted() {
        //
    },

    methods: {
        /**
         * Generate dates in month
         *
         */
        generateDates() {
            let date = this.getDate();
            let currentMonth = this.getDate().getMonth() + 1;
            date.setDate(1);
            let dates = [];
            let year, day, month;

            while ((date.getMonth() + 1) == currentMonth) {
                year = date.getFullYear();
                month = (date.getMonth() + 1).toString().padStart(2, '0');
                day = date.getDate().toString().padStart(2, '0');

                dates.push(`${year}-${month}-${day}`);
                date.setDate(date.getDate() + 1);
            }

            this.dates = dates;
        },

        getDate() {
            let date = new Date;

            if (this.month) {
                date.setMonth(this.month - 1);
            }

            if (this.year) {
                date.setFullYear(this.year);
            }

            return date;
        }
    }
};
</script>