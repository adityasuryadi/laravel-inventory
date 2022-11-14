<template>
    <line-chart
        :height="400"
        :width="400"
        :options="defaultOptions"
        :chart-data="datacollection"
    ></line-chart>
</template>

<script>
import LineChart from "./LineChart";

export default {
    components: {
        LineChart
    },
    props: {
        labels: {
            type: Array,
            default() {
                return [];
            }
        },
        datasets: {
            type: Object,
            default() {
                return {};
            }
        }
    },
    data() {
        return {
            datacollection: {
                labels: this.labels,
                datasets: [
                    {
                        label: this.datasets[0].label,
                        borderColor: "#f87979",
                        backgroundColor: "#f87979",
                        fill: false,
                        data: this.datasets[0].data
                    },
                    {
                        label: this.datasets[1].label,
                        backgroundColor: "#0000FF",
                        fill: false,
                        borderColor: "#0000FF",
                        data: this.datasets[1].data
                    }
                ]
            },
            defaultOptions: {
                responsive: true, // my new default options
                maintainAspectRatio: false, // my new default options
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                                callback(value, index, values) {
                                    if (value >= 1000) {
                                        return `Rp ${value
                                            .toString()
                                            .replace(
                                                /\B(?=(\d{3})+(?!\d))/g,
                                                "."
                                            )}`;
                                    }
                                    return `Rp ${value}`;
                                }
                            },
                            gridLines: {
                                display: true // my new default options
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: false
                            }
                        }
                    ]
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: (tooltipItems, data) => {
                            console.log(this);
                            return `Rp ${tooltipItems.yLabel
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
                        }
                    }
                }
            }
        };
    },
    computed: {
        myStyles() {
            return {
                height: `100px`,
                position: "relative"
            };
        }
    },
    mounted() {},
    methods: {
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
        }
    }
};
</script>

<style>
.small {
    max-width: 600px;
    margin: 150px auto;
}
</style>
