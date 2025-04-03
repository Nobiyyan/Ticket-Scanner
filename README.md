# 🚀 Ticket Scanner  
This is a simple barcode and QR code scanning application used for ticket validation at various events. This application ensures that tickets can only be used once, preventing misuse.  

## 📌 Features  
- 🔍 **Supports Multiple Barcode & QR Code Formats**: Reads various barcode and QR code formats for greater flexibility.  
- ✅ **Ticket Validation**: Verifies ticket authenticity by checking it against a database.  
- 🔄 **One-Time Use Tickets**: Ensures that once a ticket is scanned, it cannot be reused.  
- 📊 **Scan History**: Stores scanned ticket data for future reference and analysis.  

---  

## 🛠 Installation  
1. **Clone this repository:**  
   ```sh
   git clone <repo_url>
   ```
2. **Use XAMPP** to run a local server.  
3. **Import the database:**  
   - Load the `ticket.sql` file into your database using phpMyAdmin or MySQL.  
4. **Generate your own barcode/QR code** following the required format.  
5. **Start scanning tickets!**  

📌 _(Expand the installation tutorial as needed)_  

---  

## 🚀 How to Use  
1. **Open the Ticket Scanner application.**  
2. **Use a barcode or QR code scanner** to scan the ticket.  
3. **The application will validate the ticket** against the database.  
4. **Validation results:**  
   - ✅ If the ticket is valid → access is granted.  
   - ❌ If the ticket has already been used → access is denied.  
5. **Scan data is stored** for future reference and analysis.  
