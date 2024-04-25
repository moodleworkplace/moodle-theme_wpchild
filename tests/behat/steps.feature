@theme @theme_wpchild @moodleworkplace @javascript
Feature: Theme wpchild overview test
  To navigate in wpchild theme I need to make sure standard steps work

  Scenario: Testing basic steps in wpchild theme do not throw error.
    And I log in as "admin"
    And I set the following administration settings values:
      | contactdataprotectionofficer | 1 |
    And I navigate to "Appearance > Themes" in site administration
    And I log out

  Scenario: Testing workplace launcher in wpchild theme
    And I log in as "admin"
    And I navigate to "Courses" in workplace launcher
    And I should see "Manage courses and categories"
    And I log out

  Scenario: Testing tenant site name/shortname is shown if it is defined
    Given the following "tool_tenant > tenants" exist:
      | name    | sitename    | siteshortname |
      | Tenant1 | Tenant 1    | T1            |
      | Tenant2 |             |               |
    When I am on homepage for tenant "Tenant1"
    And I follow "Log in"
    Then I should see "Tenant 1" in the ".login-heading" "css_element"
    And I log in as "admin"
    And I switch to tenant "Tenant1"
    And I should see "T1" in the ".navbar" "css_element"
    And I log out
    And I am on homepage for tenant "Tenant2"
    And I follow "Log in"
    And I should see "Acceptance test site" in the ".login-heading" "css_element"
    And I log in as "admin"
    And I switch to tenant "Tenant2"
    And I should see "Acceptance test site" in the ".navbar" "css_element"

  Scenario: Check that background pattern appears in the branding page
    Given "1" tenants exist with "2" users and "0" courses in each
    When I log in as "tenantadmin1"
    And I navigate to "Appearance" in workplace launcher
    And I should see "Background pattern"
