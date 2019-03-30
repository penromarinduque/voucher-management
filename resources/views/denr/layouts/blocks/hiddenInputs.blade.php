<!-- TRANSACTION -->

<input type="hidden" name="com_code" value="{{ Auth::user()->COMPANY_CODE }}">
<input type="hidden" name="modified_by" value="{{ Auth::user()->USER_ID }}">

<!-- AUDIT TRAIL -->

@if($form_id == 'AddCompany')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added Company">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Add Company Form">

@elseif($form_id == 'EditCompany')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Company">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Company Form">

@elseif($form_id == 'EditCompanySetting')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Company Setting">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Company Setting Form">

@elseif($form_id == 'AddUser')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added User">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Add User Form">

@elseif($form_id == 'EditUser')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated User">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit User Form">

@elseif($form_id == 'AddUserGroup')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added User Group">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Edit User Group Form">

@elseif($form_id == 'EditUserGroup')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated User Group">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit User Group Form">

@elseif($form_id == 'AddMainAccount')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Add Main Account">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Main Account Form">

@elseif($form_id == 'EditMainAccount')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Main Account">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Main Account Form">

@elseif($form_id == 'AddSubsidiary')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Add Subsidiary">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Subsidiary Form">

@elseif($form_id == 'EditSubsidiary')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Subsidiary">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Subsidiary Form">

@elseif($form_id == 'AddIncome')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Add Income/Expense Account">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Income/Expense Account Form">

@elseif($form_id == 'EditIncome')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Income/Expense Account">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Income/Expense Account Form">

@elseif($form_id == 'AddProduction')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Add Production Cost">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Production Form Form">

@elseif($form_id == 'EditProduction')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Production Cost">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Production Cost Form">

@elseif($form_id == 'AddBook')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added Book">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Add Book Form">

@elseif($form_id == 'EditBook')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Book">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Book Form">

@elseif($form_id == 'EditProfile')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Profile">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="User Profile Form">

@elseif($form_id == 'ChangePassword')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Changed Password">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Change Password Form">

@elseif($form_id == 'AddAccess')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added User Access">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="User Access Form">

@elseif($form_id == 'EditAccess')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated User Access">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="User Access Form">

@elseif($form_id == 'AddBookAccess')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added Book User Access">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Book User Access Form">

@elseif($form_id == 'AddYearMonth')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added Year Month">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Year Month Form">

@elseif($form_id == 'EditYearMonth')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Updated Year Month">
<input type="hidden" name="audit_type" value="2">
<input type="hidden" name="audit_page" value="Edit Year Month Form">

@elseif($form_id == 'AddCompanyModule')

<input type="hidden" name="audit_user" value="{{ Auth::user()->id }}">
<input type="hidden" name="audit_task" value="Added Company Module">
<input type="hidden" name="audit_type" value="1">
<input type="hidden" name="audit_page" value="Company Module Form">

@endif