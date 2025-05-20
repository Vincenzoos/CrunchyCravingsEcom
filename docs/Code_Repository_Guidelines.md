# Code Repository (Git)

This document provides instructions for obtaining a full clone of the project repository, explains the repository structure, and outlines conventions for commit messages and branch naming. It is intended to help future developers and maintainers explore and work with the codebase efficiently.

---

## Cloning the Repository

To obtain the full codebase with all commit history, run:
```bash
git clone https://git.infotech.monash.edu/UGIE/ugie-2025/team068/team068-app_fit3047.git
```

### Alternative: Clone All Branches and Tags

If you need a full backup including all branches, tags, and refs (for migration or archival purposes), use:
```bash
git clone --mirror https://git.infotech.monash.edu/UGIE/ugie-2025/team068/team068-app_fit3047.git
```
This will create a bare mirror of the repository with all history, branches, and tags.

---

## Repository Structure

```
/config        # Configuration files
/database      # System database schema with all tables, relationships, and sample data
/docs          # System design and architecture (Domain Model, ERD)
/src           # Application source code (backend logic models, views, controllers, etc. for pages)
/templates     # View templates (frontend logic for pages)
/tests         # Unit tests for both backend and frontend
/webroot       # Public web assets (images, CSS, JS)
/README.md     # Project technical documentation
/composer.json # PHP dependencies
```

---

## Commit Message Guidelines

- Write concise and meaningful commit messages that clearly describe the change.
- Use the following format:

  ```
  [type]: [short description]

  [optional detailed body]
  ```

- **Allowed types:**
  - `feat`: New feature
  - `fix`: Bug fix
  - `docs`: Documentation changes
  - `refactor`: Code refactoring
  - `test`: Adding or updating tests
  - `chore`: Maintenance or non-functional changes

**Example:**
```
feat: Implement user registration

- Generate user models, controllers, and templates
- Add validation rules for user registration
```

---

## Branch Naming Convention

- Use clear and descriptive branch names to indicate the purpose of the branch.
- Prefix branch names with one of the following:
  - `feature/` for new features (e.g., `feature/user-authentication`)
  - `bugfix/` for bug fixes (e.g., `bugfix/cart-total-error`)
  - `docs/` for documentation updates (e.g., `docs/update-readme`)
  - `refactor/` for code refactoring (e.g., `refactor/order-service`)
  - `test/` for test-related changes (e.g., `test/add-order-tests`)
  - `chore/` for maintenance or non-functional changes (e.g., `chore/update-dependencies`)

---

This document acts as a map for future developers to explore and maintain the codebase. Please ensure all commit messages and branch names follow the conventions outlined above.