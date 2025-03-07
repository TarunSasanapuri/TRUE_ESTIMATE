const express = require("express");
const mongoose = require("mongoose");
const bcrypt = require("bcryptjs");
const bodyParser = require("body-parser");

// Initialize Express App
const app = express();
const PORT = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));

// MongoDB Connection String
const mongoURI = "your-mongodb-connection-string"; // Replace with your MongoDB Atlas URI
mongoose
  .connect(mongoURI, { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => console.log("MongoDB connected"))
  .catch((err) => console.log(err));

// Admin Schema
const adminSchema = new mongoose.Schema({
  name: String,
  email: { type: String, unique: true },
  phone: String,
  password: String,
});

const Admin = mongoose.model("Admin", adminSchema);

// Routes

// Admin Signup
app.post("/signup", async (req, res) => {
  try {
    const { name, email, phone, password } = req.body;

    // Hash Password
    const hashedPassword = await bcrypt.hash(password, 10);

    // Save Admin to MongoDB
    const newAdmin = new Admin({
      name,
      email,
      phone,
      password: hashedPassword,
    });

    await newAdmin.save();
    res.send("Admin registered successfully!");
  } catch (err) {
    console.error(err);
    res.status(500).send("Error: Email already exists or server issue.");
  }
});

// Admin Login
app.post("/login", async (req, res) => {
  try {
    const { email, password } = req.body;

    // Find Admin in DB
    const admin = await Admin.findOne({ email });
    if (!admin) {
      return res.status(400).send("Invalid email or password");
    }

    // Check Password
    const isPasswordValid = await bcrypt.compare(password, admin.password);
    if (!isPasswordValid) {
      return res.status(400).send("Invalid email or password");
    }

    res.send("Login successful!");
  } catch (err) {
    console.error(err);
    res.status(500).send("Server error");
  }
});

// Start Server
app.listen(PORT, () => console.log(`Server running on http://localhost:${PORT}`));
