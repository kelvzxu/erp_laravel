<form role="form" action="/web/database/create" method="post">  
    @csrf

    <x-forms.input-field
        id="master_pwd"
        name="master_pwd"
        type="password"
        label="Master Password"
        required="true"
        autofocus="true"
    />

    <x-forms.input-field
        id="dbname"
        name="name"
        type="text"
        label="Database Name"
        required="true"
        pattern="^[a-zA-Z0-9][a-zA-Z0-9_.-]+$"
        title="Only alphanumerical characters, underscore, hyphen, and dot are allowed"
    />

    <x-forms.input-field
        id="email"
        name="email"
        type="text"
        label="Email"
        required="true"
    />

    <x-forms.input-field
        id="password"
        name="password"
        type="password"
        label="Password"
        required="true"
    />

    <x-forms.input-field
        id="company"
        name="company"
        type="text"
        label="Company Name"
        required="true"
    />

    <x-forms.input-field
        id="phone"
        name="phone"
        type="text"
        label="Phone Number"
        required="true"
    />

    <input type="submit" value="Create Database" class="btn btn-primary float-left">
</form>
