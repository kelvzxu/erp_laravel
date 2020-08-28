<template>
  <form @submit.prevent="submit" method="post">
    <div class="o_action_manager">
      <div class="o_action o_view_controller">
        <div class="o_cp_controller">
          <div class="o_control_panel">
            <div>
              <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item">
                  <router-link class="text-primary" :to="{ name:'warehouse_index' }">Warehouses</router-link>
                </li>
                <li class="breadcrumb-item active">New</li>
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
                        class="btn btn-primary o_form_button_save text-white"
                        accesskey="s"
                      >Save</button>
                      <router-link
                        type="button"
                        class="btn btn-secondary o_form_button_cancel"
                        :to="{ name:'warehouse_index' }"
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
                <div class="o_not_full oe_button_box"></div>
                <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                  <span class="bg-danger">Archived</span>
                </div>
                <label class="o_form_label oe_edit_only">Warehouse</label>
                <h1>
                  <input
                    class="o_field_char o_field_widget o_input o_required_modifier"
                    v-model="state.name"
                    placeholder="e.g. My Warehouse"
                    type="text"
                  />
                </h1>
                <div class="o_group">
                  <div class="row">
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label o_required_modifier">Short Name</label>
                            </td>
                            <td style="width: 100%;">
                              <input class="o_input o_required_modifier" v-model="state.code" />
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
                                class="o_form_label o_readonly_modifier o_required_modifier"
                              >Company</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget"
                                name="type"
                                v-model="state.company_id"
                              >
                                <option
                                  v-for="row in company"
                                  :select="row.id == state.company_id"
                                  :key="row.id"
                                  :value="row.id"
                                >{{ row.company_name }}</option>
                              </select>
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
      state: {
        name: "",
        code: "",
        company_id: "1",
        create_uid: null,
      },
      company: [],
    };
  },
  mounted() {
    this.fetchCompany();
    this.fetchUserId();
  },
  methods: {
    fetchUserId() {
      this.user = document.getElementById("current_email").value;
      const url = "/api/user/" + this.user;
      axios
        .get(url)
        .then((response) => {
           this.user = response.data.result;
            this.state.create_uid = this.user.id;
        })
        .catch((error) => console.error(error));
    },
    fetchCompany() {
      axios
        .get("/api/company")
        .then((response) => {
          this.company = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    store_product_quant() {
      axios
        .post("/api/Products/warehouse/quant/store", this.state)
        .then((response) => {
            console.log(this.state);
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "warehouse_index" });
          } else {
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text: response.data.message,
            });
          }
        });
    },
    submit($e) {
      axios
        .post("/api/warehouse/store", this.state)
        .then((response) => {
          this.store_product_quant();
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