<template>
    <form @submit.prevent="submit" method="post"> 
        <div class="o_action_manager">
            <div class="o_action o_view_controller">
                <div class="o_cp_controller">
                    <div class="o_control_panel">
                        <div>
                            <ol class="breadcrumb" role="navigation">
                                <li class="breadcrumb-item" accesskey="b">
                                    <router-link class="text-primary" :to="{ name:'category_index' }">Product Categories</router-link>
                                </li>
                                <li class="breadcrumb-item active">New</li>
                            </ol>
                            <div class="o_cp_searchview" role="search"></div>
                        </div>
                        <div>
                            <div class="o_cp_left">
                                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                                    <div>
                                        <div class="o_form_buttons_edit" role="toolbar" aria-label="Main actions"
                                            data-original-title="" title="">
                                            <button
                                                type="submit"
                                                class="btn btn-primary o_form_button_save text-white"
                                                accesskey="s"
                                            >Save</button>
                                            <router-link
                                                type="button"
                                                class="btn btn-secondary o_form_button_cancel"
                                                :to="{ name:'category_index' }"
                                            >Discard</router-link>
                                        </div>
                                    </div>
                                </div>
                                <aside class="o_cp_sidebar">
                                    <div class="btn-group o_hidden">
                                    </div>
                                </aside>
                            </div>
                            <div class="o_cp_right">
                                <div class="btn-group o_search_options position-static" role="search"></div>
                                <nav class="o_cp_pager" role="search" aria-label="Pager">
                                </nav>
                                <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="o_content">
                    <div class="o_form_view oe_form_configuration o_form_editable">
                        <div class="o_form_sheet_bg">
                            <div class="clearfix position-relative o_form_sheet">
                                <div class="o_not_full oe_button_box">
                                    <button type="button" class="btn oe_stat_button">
                                        <i class="fa fa-fw o_button_icon fa-th-list"></i>
                                        <div class="o_field_widget o_stat_info">
                                        <span class="o_stat_value">
                                            <span class="o_field_integer o_field_number o_field_widget o_readonly_modifier">0</span>
                                        </span>
                                        <span class="o_stat_text"> Products</span></div>
                                    </button>
                                </div>
                                <div class="oe_title">
                                    <label class="o_form_label oe_edit_only">Category name</label>
                                    <h1><input class="o_field_char o_field_widget o_input o_required_modifier" v-model="state.name"
                                            placeholder="e.g. Lamps" type="text"></h1>
                                </div>
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Parent Category</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select
                                                class="o_input o_field_widget"
                                                name="type"
                                                v-model="state.parent_id"
                                                >
                                                <option
                                                    v-for="row in category"
                                                    :select="row.value == state.parent_id"
                                                    :key="row.id"
                                                    :value="row.id"
                                                >{{ row.name }}</option>
                                                <button
                                                    type="button"
                                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                                    tabindex="-1"
                                                    draggable="false"
                                                    aria-label="External link"
                                                    title="External link"
                                                ></button>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="o_group">
                                    <table class="o_group o_inner_group o_group_col_6">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" style="width: 100%;">
                                                    <div class="o_horizontal_separator">Inventory Valuation</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label o_required_modifier">Costing Method</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <select
                                                    class="o_input o_field_widget o_required_modifier"
                                                    name="type"
                                                    v-model="state.costing_method"
                                                    >
                                                    <option
                                                        v-for="row in costing"
                                                        :select="row.value == state.costing_method"
                                                        :key="row.value"
                                                        :value="row.value"
                                                    >{{ row.label }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Logistics</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label" for="o_field_input_592"
                                                    data-original-title="" title="">Force Removal Strategy</label></td>
                                            <td style="width: 100%;">
                                                <select
                                                    class="o_input o_field_widget o_required_modifier"
                                                    name="type"
                                                    v-model="state.removal_strategy_id"
                                                    >
                                                <option
                                                    v-for="row in removal"
                                                    :select="row.id == state.removal_strategy_id"
                                                    :key="row.id"
                                                    :value="row.id"
                                                >{{ row.name }}</option>
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
    </form>
</template>
<script>
export default {
  data() {
    return {
      state: {
        name:"",
        complete_name: "",
        parent_id: "",
        description: "",
        removal_strategy_id: "1",
        costing_method:"standard",
        create_uid:"",
      },
      costing: [
        { label: "Standard Price", value: "standard" },
        { label: "Average Cost (AVCO)", value: "average" },
      ],
      removal: [],
      category: [],
    };
  },
  mounted() {
    this.fetchCategory();
    this.fetchRemovalStrategy();
    this.fetchUserId();
  },
  methods: {
    // Prepare Product relation Component
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
    fetchCategory() {
      axios
        .get("/api/Products/category")
        .then((response) => {
          this.category = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchRemovalStrategy() {
      axios
        .get("/api/Removal/Strategy")
        .then((response) => {
          this.removal = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    submit($e) {
      console.log(this.state.photo);
      axios
        .post("/api/Product/category/store", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "category_index" });
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
