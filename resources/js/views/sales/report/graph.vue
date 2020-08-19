<template>
  <div class="o_action_manager">
    <div class="o_action o_graph_controller o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'sales_analysis' }">Sales Analysis</router-link>
              </li>
            </ol>
            <div class="o_cp_searchview" role="search">
              <div class="o_searchview" role="search" aria-autocomplete="list">
                <span
                  class="o_searchview_more fa fa-search-minus"
                  title="Advanced Search..."
                  role="img"
                  aria-label="Advanced Search..."
                ></span>

                <div class="o_searchview_input_container">
                  <div tabindex="0" class="o_searchview_facet"></div>
                  <input
                    type="text"
                    class="o_searchview_input"
                    accesskey="Q"
                    placeholder="Search..."
                    role="searchbox"
                    aria-haspopup="true"
                  />
                  <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="o_cp_left">
              <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                <div class="btn-group" role="toolbar" aria-label="Main actions">
                  <button class="btn btn-primary">Export</button>
                </div>
                <div class="btn-group" role="toolbar" aria-label="Change graph">
                  <button
                    class="btn btn-secondary fa fa-bar-chart-o o_graph_button o_invisible_modifier"
                  ></button>
                  <button
                    class="btn btn-secondary fa fa-area-chart o_graph_button active"
                    title
                    aria-label="Line Chart"
                    data-mode="line"
                    data-original-title="Line Chart"
                  ></button>
                  <button
                    class="btn btn-secondary fa fa-pie-chart o_graph_button o_invisible_modifier"
                  ></button>
                </div>
                <div class="btn-group" role="toolbar" aria-label="Change graph">
                  <button
                    class="btn btn-secondary fa fa-database o_graph_button o_hidden active"
                    title
                    aria-label="Stacked"
                    data-mode="stack"
                    data-original-title="Stacked"
                  ></button>
                </div>
              </div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search">
                <div>
                  <div class="btn-group o_dropdown">
                    <select
                      v-model="month"
                      class="o_filters_menu_button o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                    >
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                    <!-- <button
                      class="o_filters_menu_button o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                      data-toggle="dropdown"
                      aria-expanded="false"
                      tabindex="-1"
                      data-flip="false"
                      data-boundary="viewport"
                    >
                      <span class="fa fa-filter"></span> Filters
                    </button>-->
                  </div>
                  <div class="btn-group o_dropdown">
                    <select
                      v-model="year"
                      class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                    >
                      <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                    </select>
                    <!-- <button
                      class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                      data-toggle="dropdown"
                      aria-expanded="false"
                      tabindex="-1"
                      data-flip="false"
                      data-boundary="viewport"
                        >
                      <span class="fa fa-bars"></span> Group By
                    </button>-->
                  </div>
                </div>
              </div>
              <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher">
                <button
                  type="button"
                  class="btn btn-secondary fa fa-lg fa-bar-chart o_cp_switch_graph active"
                  aria-label="View graph"
                  data-view-type="graph"
                  title
                  tabindex="-1"
                  data-original-title="View graph"
                ></button>

                <button
                  type="button"
                  class="btn btn-secondary fa fa-lg fa-table o_cp_switch_pivot"
                  aria-label="View pivot"
                  data-view-type="pivot"
                  title
                  tabindex="-1"
                  data-original-title="View pivot"
                ></button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="o_content">
        <div class="o_graph_renderer">
            <line-chart
                :data="transaction_data" 
                :options="chartOptions" 
                :labels="labels"
                />
        </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";
import _ from "lodash";
import LineChart from "./LineChart.vue";
import { mapActions, mapState } from "vuex";

export default {
  created() {
    this.getChartData({
      month: this.month,
      year: this.year,
    });
  },
  data() {
    return {
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
      month: moment().format("MM"), 
      year: moment().format("Y"),
      state: null,
      loaded: false,
    };
  },
  watch: {
    month() {
      this.getChartData({
        month: this.month,
        year: this.year,
      });
    },
    year() {
      this.getChartData({
        month: this.month,
        year: this.year,
      });
    },
  },
  computed: {
//     ...mapState("dashboard", {
//       transactions: (state) => state.transactions, //AMBIL DATA DARI STATE
//     }),
//     //LIST TAHUN DARI 2010 SAMPAI TAHUN SAAT INI UNTUK DILOOPING DI FILTER TAG
    years() {
      return _.range(2015, moment().add(1, "years").format("Y"));
    },
    labels() {
      return _.map(this.state, function (self) {
        return moment(self.date).format("DD");
      });
    },
    transaction_data() {
      return _.map(this.state, function (self) {
        return self.total;
      });
    },
  },
  methods: {
    getChartData(payload) {
      axios
        .get(`/api/sale/analysis?month=${payload.month}&year=${payload.year}`)
        .then((response) => {
            this.state = response.data;
            this.loaded = true;
        });
    },
  },
  components: { "line-chart": LineChart },
};
</script>