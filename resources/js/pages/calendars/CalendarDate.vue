<template>
    <li
        class="list-group-item"
        :class="{ 'active' : isToday, 'bg-light' : hasEvents }"
    >
        <div class="row">
            <div class="col-3">
                {{ value | formatDate }}
            </div>
            <div class="col-9">
                <div
                    v-for="(event, index) in dateEvents"
                    :key="`event-${index}`"
                >
                    {{ event.name }}
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import ArrayMixin from 'Mixins/array.js';

export default {
    name: 'calendar-date',

    filters: {
        formatDate(value) {
            let result;

            if (value) {
                result = moment(value).format('D ddd');
            }

            return result;
        }
    },

    mixins: [ ArrayMixin ],

    props: {
        value: {
            default: null,
            type: String
        },

        events: {
            default: () => {
                return new Array;
            },
            type: Array
        }
    },

    computed: {
        /**
         * Filter events for current date
         *
         * @return {Array}
         */
        dateEvents() {
            let events = this.events;

            events = events.filter(obj => obj.date == this.value);

            return events;
        },

        /**
         * Check if current date
         *
         * @return {Boolean}
         */
        isToday() {
            return moment().startOf('day').diff(this.value, 'days') == 0;
        },

        /**
         * Check if has events for current date
         *
         * @return {Boolean}
         */
        hasEvents() {
            return this.array_count(this.dateEvents) > 0 && ! this.isToday;
        }
    }
};
</script>