# Changelog

All notable changes to `PasswordChecker` will be documented in this file.

## Version 1.2.0
### Added
- 🆕 Add livewire component with strength bar
  - ℹ Pass a score parameter to the component to show a bar
- 🆕 Added one more msg tier on the livewire component dynamic output
- 🆕 Tests for the livewire component
  - ℹ Assertions for http 200 and some texts based on predetermined scores and default threshold (25)
### Changed
- 🔧 Made the livewire component namespaced and more specific
- 🔧 Enable livewire in pest test case
  - pulled the pest livewire plugin also

## Version 1.1.1
### Added
- 🆕 Add additional test case for the password score rule

### Changed
- 🔧 Updated the scoring multipliers for entropy and length.
- 🔧 Updated the length base score to make it equal to the length of the string being checked, past a certain minimum length.
- 🔧 Updated the variety base score to make lowerCase characters less penalizing when repeated, and lowered the value of spaces counted from .5 to .25.
- 🔧 Updated related tests as needed to adjust to the new scoring.

## Version 1.1.0

### Added
- 🆕 Add github actions.

### Changed
- 🔧 Some dependencies updated.

## Version 1.0.2
### Added
- 🆕 Add some github actions.

### Fixed
- 🐛 Fixed the `passwordchecker` config file reference inside the rule constructor when getting the default config threshold.

## Version 1.0.1

### Added
- 🌎 Locale for the validation rule error message. 
- 🧾 Tests for each of the locale messages.
  - 🛃 These will be the baseline. If new locale are added, I want to see tests for them!
- 🆕 New, separate tag for vendor publishing of locale only.

### Fixed
- 🤣 Removed the vendor folder form the repository. 
  - 😱 What was I thinking?!  
  - 🤪 Thinking?! 
  - 🤕 I was... not thinking! 
- Removed facades ¯\\_(ツ)\_/¯ _They are not needed._
- 🎉 Fixed all phpstan issues. 
  - 🔠🔡 Fixed namespace casing.
  - 👬 Removed duplicate larastan packages (old and new versions of the same package with different namespaces).  
- 🧟 Remove unused statements on service provider. 

## Version 1.0.0

### Added
- Everything. ✨ With a bit of hope and a pinch of good intentions. 
