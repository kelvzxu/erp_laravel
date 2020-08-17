<template>
  <form @submit.prevent="submit" method="post">
    <div class="o_action_manager">
      <div class="o_action o_view_controller">
        <div class="o_cp_controller">
          <div class="o_control_panel">
            <div>
              <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b">
                  <router-link class="text-primary" :to="{ name:'uom_index' }">Units of Measure</router-link>
                </li>
                <li class="breadcrumb-item active">{{state.name}}</li>
              </ol>
              <div class="o_cp_searchview" role="search"></div>
            </div>
            <div>
              <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                  <div>
                    <div
                      class="o_form_buttons_edit"
                      role="toolbar"
                      aria-label="Main actions"
                      data-original-title
                      title
                    >
                      <button
                        type="submit"
                        class="btn btn-primary o_form_button_save"
                        accesskey="s"
                      >Save</button>
                      <router-link
                        type="button"
                        class="btn btn-secondary o_form_button_cancel"
                        :to="{ name:'uom_index' }"
                      >Discard</router-link>
                    </div>
                  </div>
                </div>
                <aside class="o_cp_sidebar"></aside>
              </div>
              <div class="o_cp_right">
                <div class="btn-group o_search_options position-static" role="search"></div>
                <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
                <nav
                  class="btn-group o_cp_switch_buttons"
                  role="toolbar"
                  aria-label="View switcher"
                ></nav>
              </div>
            </div>
          </div>
        </div>

        <div class="o_content">
          <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
              <div class="clearfix position-relative o_form_sheet">
                <div class="o_group">
                  <div class="row">
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_100"
                              >Unit of Measure</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input o_field_translate o_required_modifier"
                                name="name"
                                placeholder
                                v-model="state.name"
                                type="text"
                                id="o_field_input_100"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_101"
                                data-original-title
                                title
                              >Category</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_required_modifier"
                                aria-atomic="true"
                                name="category_id"
                              >
                                <div class="o_input_dropdown">
                                  <select
                                    @change="change_category"
                                    v-model="state.category_id"
                                    class="o_input ui-autocomplete-input"
                                  >
                                    <option
                                      v-for="row in category"
                                      :key="row.id"
                                      :value="row.id"
                                    >{{ row.name }}</option>
                                  </select>
                                </div>
                                <button
                                  type="button"
                                  class="fa fa-external-link btn btn-secondary o_external_button"
                                  tabindex="-1"
                                  draggable="false"
                                  aria-label="External link"
                                  title="External link"
                                  style="display: none;"
                                ></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_102"
                              >Type</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                @change="change_type"
                                class="o_input o_field_widget o_required_modifier"
                                v-model="state.uom_type"
                                id="o_field_input_102"
                              >
                                <option
                                  v-for="row in type"
                                  :select="row.code == state.uom_type"
                                  :key="row.code"
                                  :value="row.code"
                                >{{ row.name }}</option>
                              </select>
                            </td>
                          </tr>
                          <tr v-if="state.uom_type == 'smaller'">
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_103"
                                data-original-title
                                title
                              >Ratio</label>
                            </td>
                            <td style="width: 100%;">
                              <div v-if="state.uom_type == 'smaller'" class="o_row">
                                <input
                                  class="o_input o_required_modifier"
                                  v-model="state.factor"
                                  placeholder
                                  width="40px"
                                  type="text"
                                />
                                <span class="oe_grey">e.g: 1*(reference unit)=ratio*(this unit)</span>
                              </div>
                            </td>
                          </tr>
                          <tr v-if="state.uom_type == 'bigger'">
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_104"
                                data-original-title
                                title
                              >Bigger Ratio</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row">
                                <input
                                  class="o_input o_required_modifier"
                                  v-model="state.factor"
                                  placeholder
                                  width="40px"
                                  type="text"
                                />
                                <span class="oe_grey">e.g: 1*(this unit)=ratio*(reference unit)</span>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_105"
                                data-original-title
                                title
                              >Active</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_boolean o_field_widget custom-control custom-checkbox"
                                name="active"
                              >
                                <input
                                  type="checkbox"
                                  :checked="state.active == true"
                                  v-model="state.active"
                                  id="o_field_input_105"
                                  class="custom-control-input"
                                />
                                <label for="o_field_input_105" class="custom-control-label">&#8203;</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_106"
                                data-original-title
                                title
                              >Rounding Precision</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_float o_field_number o_field_widget o_input o_required_modifier"
                                v-model="state.rounding"
                                placeholder
                                type="text"
                                id="o_field_input_106"
                              />
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
  </form>
</template>
<script>
export default {
  data() {
    return {
      state: {},
      category: [],
      type: [],
    };
  },
  mounted() {
    this.fetchUomCategory();
    this.fetchUomType();
  },
  created() {
    axios
      .get(`/api/uom/get_uom/${atob(this.$route.params.id)}`)
      .then((response) => {
        console.log("ok");
        this.state = response.data.result;
        console.log(this.state);
      });
  },
  methods: {
    fetchUomCategory() {
      axios
        .get("/api/uom/category/list")
        .then((response) => {
          this.category = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchUomType() {
      axios
        .get("/api/uom/type/list")
        .then((response) => {
          this.type = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    change_category() {
      this.state.uom_type = "reference";
    },
    change_type() {
      this.uom_type = this.state.uom_type;
      this.state.factor = "1.00000";
    },
    submit($e) {
      axios
        .post("/api/uom/update", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "uom_index" });
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
    },
  },
};
</script>