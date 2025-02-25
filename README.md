# Halcon Web Application Analysis and Diagrams

## Overview
Halcon is a construction material distributor that requires a web application to automate its internal processes. This repository contains the analysis documentation and design diagrams for the proposed system.

## Table of Contents
1. [Project Description](#project-description)
2. [Functional Requirements](#functional-requirements)
3. [User Roles and Permissions](#user-roles-and-permissions)
4. [Order Lifecycle Process](#order-lifecycle-process)
5. [Diagrams](#diagrams)

## Project Description
Halcon’s proposed web application will serve two primary audiences:
- **Customers:** Who can check the status of their orders by entering their customer number and invoice number.
- **Internal Personnel:** Who use an administrative dashboard to manage orders and perform tasks specific to their department.

The application will support the entire order lifecycle from order creation to final delivery, including photo uploads for proof of shipment and delivery.

## Functional Requirements
### Customer-Facing Features:
- **Order Status Inquiry:** 
  - A main screen where a customer enters a customer number and invoice number.
  - Display the current status of the order.
  - If the status is “Delivered”, show a photo as evidence of delivery.

### Administrative Features (Internal Personnel):
- **User Management:**
  - A default administrative user exists to register new users and assign roles.
  - **Roles:** Sales, Purchasing, Warehouse, and Route.
- **Order Management:**
  - Sales personnel create new orders capturing:
    - Consecutive invoice number
    - Customer name/company
    - Unique customer number
    - Fiscal data (for invoice purposes)
    - Date and time of order
    - Delivery address
    - Additional notes
  - **Order Lifecycle Statuses:**
    - **Ordered:** Order entry by Sales.
    - **In Process:** Order is being prepared (either from internal stock or via purchase).
    - **In Route:** Order is on its way; at this stage, the Route department uploads a photo of the loaded unit.
    - **Delivered:** Delivery confirmation; a photo is uploaded as evidence.
- **Order Listing and Search:**
  - A screen listing all orders with filtering by Invoice Number, Customer Number, Date, or Status.
- **Logical Deletion and Restoration:**
  - Orders can be modified or marked as “deleted” (logical deletion).
  - A separate screen lists deleted orders, with options to edit or restore them.

## User Roles and Permissions
- **Administrator:** Can register new users and assign departmental roles.
- **Sales:** Responsible for taking customer orders.
- **Purchasing:** Handles orders for missing materials.
- **Warehouse:** Manages stock, prepares orders, and communicates with Purchasing.
- **Route:** Uploads photos for both loaded and delivered orders (this option is visible only to Route users).
- **Customer:** No registration required; customers can check their order status via a public-facing screen.

## Order Lifecycle Process
1. **Order Placement:**
   - A customer calls, and the Salesperson enters the order details.
2. **Initial Status – Ordered:**
   - The order is logged and visible to all departments.
3. **Processing – In Process:**
   - A Warehouse user prepares the order; if items are missing, Purchasing is involved.
4. **Dispatch – In Route:**
   - The order is marked “In route” once ready, and a Route user loads the order, uploading a “loaded” photo.
5. **Delivery Confirmation – Delivered:**
   - Upon delivery, the Route user uploads a “delivered” photo.
   - The system updates the order status to “Delivered.”

## Diagrams
Below are the planned diagrams for this project (actual diagrams in the `/diagrams` folder):

- **BPMN Diagram:** Illustrates the business processes and workflow for order management.
- **Class Diagram:** Defines the classes, their attributes, and methods for the system.
- **Activity Diagram:** Details the step-by-step process of the order lifecycle.
- **Use Case Diagram:** Illustrates the interactions between users (Customer, Sales, Purchasing, Warehouse, Route, Administrator) and system functionalities.
- **ER Diagram:** Defines the database entities (Orders, Users, Roles, etc.) and their relationships.

