<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item">
                <router-link class="text-primary" :to="{ name:'general_setting' }">General Settings</router-link>
              </li>
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'lang_index' }">Languages</router-link>
              </li>
              <li class="breadcrumb-item active">{{state.lang_name}}</li>
            </ol>
            <div class="o_cp_searchview" role="search"></div>
          </div>
          <div>
            <div class="o_cp_left">
              <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar"></div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right"></div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_readonly">
          <div class="o_form_sheet_bg">
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box">
                <button type="button" class="btn oe_stat_button" @click="activate">
                  <i class="fa fa-fw o_button_icon fa-refresh"></i>
                  <span>Activate and Translate</span>
                </button>
              </div>
              <div class="oe_title">
                <label class="o_form_label oe_edit_only" for="o_field_input_540">Name</label>
                <h2>
                  <span
                    class="o_field_char o_field_widget o_required_modifier"
                    name="name"
                  >{{state.lang_name}}</span>
                </h2>
              </div>
              <div class="o_group">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_541"
                              data-original-title
                              title
                            >Locale Code</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_required_modifier"
                              name="code"
                            >{{state.code}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_542"
                              data-original-title
                              title
                            >ISO code</label>
                          </td>
                          <td style="width: 100%;">
                            <span class="o_field_char o_field_widget" name="iso_code">{{state.iso_code}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_543"
                              data-original-title
                              title
                            >URL Code</label>
                          </td>
                          <td style="width: 100%;">
                            <span class="o_field_char o_field_widget" name="url_code">{{state.url_code}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label class="o_form_label" for="o_field_input_544">Active</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_boolean o_field_widget custom-control custom-checkbox"
                              name="active"
                            >
                              <input
                                type="checkbox"
                                v-model="state.active"
                                class="custom-control-input"
                                disabled
                              />
                              <label for="o_field_input_544" class="custom-control-label">&#8203;</label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_545"
                            >Direction</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              name="direction"
                              class="o_field_widget o_required_modifier"
                            >{{state.direction}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_546"
                              data-original-title
                              title
                            >Separator Format</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_required_modifier"
                              name="grouping"
                            >{{state.grouping}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_547"
                            >Decimal Separator</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_required_modifier"
                              name="decimal_point"
                            >{{state.decimal_point}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label class="o_form_label" for="o_field_input_548">Thousands Separator</label>
                          </td>
                          <td style="width: 100%;">
                            <span class="o_field_char o_field_widget" name="thousands_sep">,</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_549"
                            >Date Format</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_required_modifier"
                              name="date_format"
                            >{{state.date_format}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_550"
                            >Time Format</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_required_modifier"
                              name="time_format"
                            >{{state.time_format}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_551"
                            >First Day of Week</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              name="week_start"
                              class="o_field_widget o_required_modifier"
                            >{{days}}</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      state: {},
      days:null,
    };
  },
  created() {
    axios
      .post(`/api/lang/search/${atob(this.$route.params.id)}`)
      .then((response) => {
          this.state = response.data.result;
          this.prepare_day();
      })
      .catch((error) => console.error(error));
  },
  mounted() {
  },
  methods: {
    SetDay() {
      if (this.state.week_start == '1') return 'Monday' 
      if (this.state.week_start == '2') return 'Tuesday' 
      if (this.state.week_start == '3') return 'Wednesday' 
      if (this.state.week_start == '4') return 'Thursday' 
      if (this.state.week_start == '5') return 'Friday' 
      if (this.state.week_start == '6') return 'Saturday' 
      if (this.state.week_start == '7') return 'Sunday' 
    },
    prepare_day()
    {
        this.days = this.SetDay();
    },
    activate(){
        axios
        .post("/api/lang/activate", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "lang_index" });
          } else {
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text: response.data.message,
            });
          }
        })
        .catch((error) => {
          if (error) {
            if (error.response.status == 422) {
              var error = error.response.data.errors;
              error = error[Object.keys(error)[0]];
              Swal.fire({
                type: "warning",
                title: "Something went wrong!",
                text: error[0],
              });
            }
          }
        });
    }
  },
};
</script>