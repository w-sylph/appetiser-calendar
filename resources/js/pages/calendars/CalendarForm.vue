<template>
    <form
        @submit.prevent="submit"
    >
        <div class="row">
            <text-field
                v-model="event"
                class="col-12"
                label="Event"
                name="name"
            />
            <date-picker
                v-model="dateFrom"
                class="col-6"
                label="From"
                name="date_from"
                placeholder="Choose a date"
                date-format="Y-m-d"
                alt-input
                :enable-time="false"
            />
            <date-picker
                v-model="dateTo"
                class="col-6"
                label="To"
                name="date_to"
                placeholder="Choose a date"
                date-format="Y-m-d"
                alt-input
                :enable-time="false"
            />

            <div class="col-12 mb-3">
                <div
                    v-for="(dayOfWeek, index) in dayOfWeeks"
                    :key="`day-of-week-${index}`"
                    class="form-check form-check-inline"
                >
                    <input
                        :id="`day-of-week-${index}`"
                        class="form-check-input"
                        name="day_of_weeks[]"
                        type="checkbox"
                        :value="dayOfWeek.value"
                    >
                    <label
                        class="form-check-label"
                        :for="`day-of-week-${index}`"
                    >
                        {{ dayOfWeek.label }}
                    </label>
                </div>
            </div>

            <div class="col-12 mb-3">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import ResponseMixin from 'Mixins/response.js';
import TextField from 'Components/inputs/TextField.vue';
import DatePicker from 'Components/inputs/DatePicker.vue';

export default {
    name: 'calendar-form',

    components: {
        TextField,
        DatePicker
    },

    mixins: [ ResponseMixin ],

    data: () => ({
        loading: null,
        event: null,
        dateFrom: null,
        dateTo: null,

        dayOfWeeks: [
            {
                label: 'Mon',
                value: 1
            },
            {
                label: 'Tue',
                value: 2
            },
            {
                label: 'Wed',
                value: 3
            },
            {
                label: 'Thu',
                value: 4
            },
            {
                label: 'Fri',
                value: 5
            },
            {
                label: 'Sat',
                value: 6
            },
            {
                label: 'Sun',
                value: 0
            }
        ]
    }),

    methods: {
        submit(event) {
            let params = new FormData(event.target);

            axios.post(this.routes['calendars.store'], params)
                .then(response => {
                    this.parseSuccess(response.data.message);
                    this.$emit('success');
                }).catch(error => {
                    this.parseError(error);
                }).then(() => {

                });
        },

        load(value) {
            this.loading = value;
            this.$emit('load', value);
        }
    }
};
</script>