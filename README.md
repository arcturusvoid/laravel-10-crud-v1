# Laravel 10 CRUD version 1

### Project Idea
1. User can create a help ticket.
2. Admin can reply on help ticket.
3. Admin can reject or resolve ticket.
4. If the admin updated the help ticket, the user will get one notification via email that ticket status is updated.
5. User can set the ticket title and description.
6. User can upload a document like pdf or image.

### Table Structure
1. Tickets
    - title (string, required)
    - desctription (text, required)
    - status: (open-default, resolve, rejected)
    - attachment (string, nullable)
    - user_id (int, required)
    - status_changed_by_id (int, nullable)
2. Reply
    - body (text, required)
    - user_id (int, required)
    - ticket_id (int, required)