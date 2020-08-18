<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div> 
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'company_index' }">Companies</router-link>
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
                      class="btn btn-primary text-white o_form_button_save"
                      accesskey="s"
                    >Save</button>
                    <router-link
                      type="button"
                      class="btn btn-secondary o_form_button_cancel"
                      :to="{ name:'sales_index' }"
                    >Discard</router-link>
                  </div>
                </div>
              </div>
              <aside class="o_cp_sidebar">
                <div class="btn-group o_hidden"></div>
              </aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search"></div>
              <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_editable">
          <div class="o_form_sheet_bg">
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_field_image o_field_widget oe_avatar" aria-atomic="true">
                <img
                  id="picture"
                  class="img img-fluid"
                  v-bind:src="'/images/icons/your_logo.png'"
                  border="1"
                />

                <div class="o_form_image_controls">
                  <span class="input-group-btn">
                    <span class="btn btn-default btn-file bg-primary text-white">
                      Browse…
                      <input
                        type="file"
                        id="imgInp"
                        ref="file"
                        name="photo"
                        v-on:change="handleFileUpload()"
                      />
                    </span>
                  </span>
                </div>
              </div>
              <span
                class="o_field_integer o_field_number o_field_widget o_invisible_modifier o_readonly_modifier"
                name="partner_gid"
              >0</span>
              <div class="oe_title">
                <label class="o_form_label oe_edit_only" for="o_field_input_28">Company Name</label>
                <h1>
                  <div
                    class="o_field_partner_autocomplete dropdown open o_field_widget o_required_modifier"
                    name="name"
                  >
                    <input class="o_input" placeholder type="text" v-model="state.name" />
                  </div>
                </h1>
              </div>
              <div class="o_notebook">
                <div class="o_notebook_headers">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_29"
                        class="nav-link active"
                        role="tab"
                      >General Information</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_28"
                        class="nav-link"
                        role="tab"
                      >Social Media</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_29">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier o_readonly_modifier"
                                    for="o_field_input_30"
                                  >Contact</label>
                                </td>
                                <td style="width: 100%;">
                                  <a
                                    class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                    href="#"
                                    name="partner_id"
                                    id="o_field_input_30"
                                  >
                                    <span></span>
                                  </a>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label class="o_form_label" for="o_field_input_31">Address</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_address_format">
                                    <input
                                      class="o_field_char o_field_widget o_input o_address_street"
                                      v-model="state.street"
                                      placeholder="Street..."
                                      type="text"
                                    />
                                    <input
                                      class="o_field_char o_field_widget o_input o_address_street"
                                      v-model="state.street2"
                                      placeholder="Street 2..."
                                      type="text"
                                    />
                                    <input
                                      class="o_field_char o_field_widget o_input o_address_city"
                                      v-model="state.city"
                                      placeholder="City"
                                      type="text"
                                    />
                                    <div
                                      class="o_field_widget o_field_many2one o_address_state"
                                      placeholder="State"
                                    >
                                      <div class="o_input_dropdown">
                                        <select
                                          v-model="state.state_id"
                                          class="o_input ui-autocomplete-input"
                                        >
                                          <option :select="state.state_id" :value="null">State</option>
                                          <option
                                            v-for="row in country_state"
                                            :select="row.id == state.state_id"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.state_name }}</option>
                                        </select>
                                      </div>
                                    </div>
                                    <input
                                      class="o_field_char o_field_widget o_input o_address_zip"
                                      v-model="state.zip"
                                      placeholder="ZIP"
                                      type="text"
                                    />
                                    <div
                                      class="o_field_widget o_field_many2one o_address_country"
                                      aria-atomic="true"
                                      name="country_id"
                                      placeholder="Country"
                                    >
                                      <div class="o_input_dropdown">
                                        <select
                                          @change="onChangeCountry"
                                          v-model="state.country_id"
                                          class="o_input ui-autocomplete-input"
                                        >
                                          <option :select="state.country_id" :value="null">country</option>
                                          <option
                                            v-for="row in country"
                                            :select="row.id == state.country_id"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.country_name }}</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label class="o_form_label" for="o_field_input_32">Phone</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input o_force_ltr"
                                    v-model="state.phone"
                                    placeholder
                                    type="text"
                                    id="o_field_input_32"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label class="o_form_label" for="o_field_input_33">Email</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    v-model="state.email"
                                    placeholder
                                    type="text"
                                    id="o_field_input_33"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label class="o_form_label" for="o_field_input_34">Website</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_url o_field_widget o_input"
                                    v-model="state.website"
                                    placeholder="e.g. https://www.google.com"
                                    type="text"
                                    id="o_field_input_34"
                                  />
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
                                    for="o_field_input_35"
                                    data-original-title
                                    title
                                  >VAT</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_partner_autocomplete dropdown open o_field_widget"
                                    name="vat"
                                  >
                                    <input
                                      class="o_input"
                                      placeholder
                                      type="text"
                                      v-model="state.vat"
                                    />
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_36"
                                  >Company Registry</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    v-model="state.company_registry"
                                    placeholder
                                    type="text"
                                    id="o_field_input_36"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_required_modifier"
                                    for="o_field_input_37"
                                  >Currency</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_field_widget o_field_many2one o_required_modifier">
                                    <select
                                      v-model="state.currency_id"
                                      class="o_input ui-autocomplete-input"
                                    >
                                      <option :select="state.currency_id" :value="null">currency</option>
                                      <option
                                        v-for="row in currency"
                                        :select="row.id == state.currency_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.currency_name }} ({{ row.symbol }})</option>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label class="o_form_label" for="o_field_input_38">Parent Company</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="parent_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <select
                                        v-model="state.parent_id"
                                        class="o_input ui-autocomplete-input"
                                      >
                                        <option :select="state.parent_id" :value="null"></option>
                                        <option
                                          v-for="row in parent"
                                          :select="row.id == state.parent_id"
                                          :key="row.id"
                                          :value="row.id"
                                        >{{ row.company_name }}</option>
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
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_39"
                                    data-original-title
                                    title
                                  >Sequence</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_integer o_field_number o_field_widget o_input o_invisible_modifier"
                                    name="sequence"
                                    placeholder
                                    type="text"
                                    id="o_field_input_39"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_40"
                                    data-original-title
                                    title
                                  >Company Favicon</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_image o_field_widget o_invisible_modifier float-left oe_avatar"
                                    aria-atomic="true"
                                    name="favicon"
                                  >
                                    <img
                                      class="img img-fluid"
                                      alt="Binary file"
                                      src="data:image/png;base64,AAABAAEAEBAAAAAAIAAFAgAAFgAAAIlQTkcNChoKAAAADUlIRFIAAAAQAAAAEAgGAAAAH/P/YQAAAcxJREFUeJyV0j1rlEEUBeDnvnnXGEkQkRRWfhVaiaIWGgsVN2hjZycG/4CF+LGlhcUKgii2CkkhiGUEIRFRglqYIn9AgoJoJxo3yO7mHYudyGpQ9AzTnHPPncu5EzLunbiuVtRI1gsHcAy7sQ5v8Qwv0UopmZhtgIDJ8aZ2p2uwVtuHiziJzat6xhfM4sbyytL80MCwiZmGmKw3DQ8OabW/n8Yt7PB3LOLCQBGPuyuVMiK02t8P4Q625qJveI0FlNiPgxjCdtxeqdKniJgvMYwrfeZ3uJqYDpajKFRVNRKcwXVsyVNeTimdL3EkBwYtNEI8TCrnZnpBTdabS7XauvudbqfAXQyiHhGHCxzFxtzgVWK6kkxkM0zMNrS7HYlHeJPpTThe/BbaQiFaKVVro0tJEfEF833szsKvq0prnatCWlXbfXRR4H0fsaeSNkQUaxpEhEq1AXv66MUCc3prg7FgPDBVb/6smqw3Re+MYyzTX/G8TLyI3s7rGEETyyk8mxq/0c3jlzietZHc4DnmyuAzbmIvRrELD0I8kRMPcRCn9L43fMiepRJSSk8jopFfGM2FZ/P9HR9xqbPSnSuLAbHt2rY/Jv8vWBv3f+IHI8+R5ISaw30AAAAASUVORK5CYII="
                                      border="1"
                                      name="favicon"
                                    />

                                    <div class="o_form_image_controls">
                                      <button
                                        class="fa fa-pencil fa-lg float-left o_select_file_button"
                                        title="Edit"
                                        aria-label="Edit"
                                      ></button>
                                      <button
                                        class="fa fa-trash-o fa-lg float-right o_clear_file_button"
                                        title="Clear"
                                        aria-label="Clear"
                                      ></button>

                                      <span class="o_form_binary_progress">Uploading...</span>

                                      <div class="o_hidden_input_file" aria-atomic="true">
                                        <form
                                          class="o_form_binary_form"
                                          method="post"
                                          enctype="multipart/form-data"
                                          action="/web/binary/upload"
                                        >
                                          <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="1c1730f008864ee3272347a2a8e319aafb9b12c1o"
                                          />
                                          <input type="hidden" name="callback" />

                                          <input type="file" class="o_input_file" name="ufile" />
                                        </form>
                                        <iframe style="display: none"></iframe>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_28">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Social Media</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_22"
                                data-original-title
                                title
                              >Twitter Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_twitter"
                                placeholder
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_23"
                                data-original-title
                                title
                              >Facebook Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_facebook"
                                placeholder
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_24"
                                data-original-title
                                title
                              >GitHub Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_github"
                                placeholder
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_25"
                                data-original-title
                                title
                              >LinkedIn Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_linkedin"
                                placeholder
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_26"
                                data-original-title
                                title
                              >Youtube Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_youtube"
                                placeholder
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_27"
                                data-original-title
                                title
                              >Instagram Account</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.social_instagram"
                                placeholder
                                type="text"
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
  </div>
</template>
<script>
export default {
  data() {
    return {
      state: {
        name: "",
        parent_id: null,
        country_id: null,
        state_id: null,
        currency_id: null,
        street: null,
        street2: null,
        city: null,
        zip: null,
        phone: null,
        email: null,
        website: null,
        val: null,
        company_registry: null,
        parent_id: null,
        social_twitter: null,
        social_facebook: null,
        social_youtube: null,
        social_instagram: null,
        social_github: null,
        social_linkedin: null,
      },
      country: {},
      country_state: {},
      currency: {},
      parent: {},
    };
  },
  mounted() {
    this.fetchCompany();
    this.fetchCountry();
    this.fetchCurrency();
    this.prepare_country_state();
  },
  methods: {
    fetchCompany() {
      axios
        .get("/api/company")
        .then((response) => {
          this.parent = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    fetchCountry() {
      axios
        .get("/api/country")
        .then((response) => {
          this.country = response.data;
        })
        .catch((error) => console.error(error));
    },
    fetchState() {
      axios
        .get("/api/state")
        .then((response) => {
          this.country_state = response.data;
        })
        .catch((error) => console.error(error));
    },
    fetchCurrency() {
      axios
        .get("/api/currency")
        .then((response) => {
          this.currency = response.data;
        })
        .catch((error) => console.error(error));
    },
    prepare_country_state() {
      this.country_state = {};
      if (this.state.country_id == null) this.fetchState();
      else this.getState(this.state.country_id);
    },
    onChangeCountry() {
      this.prepare_country_state();
    },
    // handle Upload File
    handleFileUpload() {
      this.createImage(this.$refs.file.files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.state.photo = e.target.result;
        this.set_image(vm.state.photo);
      };
      reader.readAsDataURL(file);
    },
    set_image(file) {
      document.getElementById("picture").src = file;
    },
  },
};
</script>
