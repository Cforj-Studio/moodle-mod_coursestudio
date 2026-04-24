# Course Studio — Moodle Plugin

Activity module (`mod_coursestudio`) that embeds interactive Course Studio courses directly inside Moodle.

## Features

- Embed any Course Studio course as a Moodle activity
- Students view and complete courses without leaving Moodle
- Automatic grade passback to Moodle Gradebook via postMessage
- Configurable player height per activity
- Admin-level settings for Course Studio URL and API key
- Activity completion tracking

## Installation

1. Download `mod_coursestudio.zip`
2. Go to **Site administration → Plugins → Install plugins**
3. Upload the ZIP file and follow the on-screen instructions
4. After installation, go to **Site administration → Plugins → Activity modules → Course Studio**
5. Set the **Course Studio URL** (e.g. `https://app.cforj.studio`) and optionally an API Key

## Usage

1. Open a Moodle course and turn editing on
2. Click **Add an activity or resource** → select **Course Studio**
3. Fill in the form:
   - Activity name
   - Course ID (UUID from your Course Studio dashboard)
   - Player height (default 700px)
   - Enable grading and set maximum grade
4. Save — students will see the embedded course

## Grading

When a learner completes a course, the Course Studio player sends a `CS_COMPLETE` postMessage with a score (0–1). The plugin normalises the score to the configured maximum grade and writes it to the Moodle Gradebook automatically.

## Capabilities

| Capability | Default roles |
|---|---|
| `mod/coursestudio:addinstance` | editingteacher, manager |
| `mod/coursestudio:view` | student, teacher, manager |
| `mod/coursestudio:grade` | teacher, editingteacher, manager |

## Requirements

- Moodle 4.1 or later
- PHP 7.4 or later

## License

GNU GPL v3 or later — https://www.gnu.org/copyleft/gpl.html
