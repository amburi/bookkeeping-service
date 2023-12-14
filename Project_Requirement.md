# Bookkeeping Service — Project Requirements

## Overview
The project aims to develop a **bookkeeping service** that enables users to **record** and **retrieve** transactions. The service will provide a comprehensive system for tracking the transfer of assets between entities, ensuring accurate financial management and reporting.

## Functional Requirements

1. **Transaction Recording:**
    - The system must allow users to record transactions with the following details:
        - **Transaction Date and Time:** The exact date and time when the transaction occurred.
        - **Party:** The entity initiating the transaction.
        - **Counterparty:** The entity receiving the asset or payment.
        - **Asset:** The item of value being transferred, which could include stocks, cars, houses, etc.
        - **Transaction Type:** One of the four specified types (Deposit, Withdrawal, Buy, Sell).
        - **Amount:** The monetary value in Euros (€) involved in the transaction.

2. **Transaction Types:**
    - The system must support the following transaction types with their respective functionalities:
        - **Deposit:** Recording the deposit of a specified amount in Euros from the party to the counterparty.
        - **Withdrawal:** Recording the withdrawal of a specified amount in Euros from the counterparty to the party.
        - **Buy:** Recording the purchase of an asset by the party from the counterparty, with the asset's value exchanged in Euros.
        - **Sell:** Recording the sale of an asset by the party to the counterparty, with the asset's value received in Euros.

3. **Data Retrieval:**
    - The system must provide functionality to retrieve information from recorded transactions, such as:
        - **Balance Enquiry:** Calculating and displaying the current balance of an entity based on recorded transactions.
        - **Asset Ownership:** Displaying the current assets owned by an entity and their associated values.
        - **Transaction History:** Providing a detailed history of all transactions involving a particular entity or asset.

## Example Scenarios

- **Deposit Example:**
    - If Person A deposits €200 to Person B, Person A's balance should reflect a credit of +€200, while Person B's balance should show a debit of -€200.

- **Withdrawal Example:**
    - If Person A withdraws €200 from Person B, Person A's balance should reflect a debit of -€200, while Person B's balance should show a credit of +€200.

- **Buy Example:**
    - If Person A buys 3 shares of stock APPL from Person B at €100 per share, Person A's balance should decrease by €300, and they should own 3 shares of APPL. Person B's balance should increase by €300, and they should have a deficit of 3 shares of APPL.

- **Sell Example:**
    - If Person A sells 2 shares of stock APPL to Person B at €120 per share, Person A's balance should increase by €240, and they should have a deficit of 2 shares of APPL. Person B's balance should decrease by €240, and they should own 2 shares of APPL.

Certainly! Here's an example of a non-functional requirement for the bookkeeping service project:


## Non-Functional Requirements

1. **Performance:**
    - The bookkeeping service must ensure high performance and responsiveness. The system should be capable of handling a large number of transactions without degradation in speed or functionality.
    - **Response Time:** The system should provide a response time of less than 2 seconds for transaction recording and retrieval under normal load conditions.
    - **Throughput:** The system must support at least 1000 concurrent users performing transaction operations without any significant performance impact.

2. **Scalability:**
    - The system must be scalable to accommodate growing amounts of data and an increasing number of users. It should be able to scale out horizontally to handle peak loads and future expansion needs.
    - **Vertical Scaling:** The system should support increased computational resources without requiring significant changes to the architecture.
    - **Horizontal Scaling:** The system architecture must facilitate the addition of more servers to distribute the load effectively.

3. **Security:**
    - The system must implement robust security measures to protect sensitive financial data from unauthorized access, breaches, and other security threats.
    - **Data Encryption:** All financial data must be encrypted both in transit and at rest using industry-standard encryption protocols.
    - **Access Control:** The system should have a comprehensive access control mechanism to ensure that users can only access the data and functionalities relevant to their role.

4. **Reliability:**
    - The bookkeeping service must be reliable and available at all times, with minimal downtime.
    - **Uptime:** The system should aim for an uptime of 99.9% or higher.
    - **Backup and Recovery:** Regular backups must be performed, and the system should have a disaster recovery plan in place to restore services quickly in case of failure.

5. **Usability:**
    - The system should have an intuitive and user-friendly interface that allows users to perform their tasks efficiently and effectively.
    - **User Interface:** The design of the user interface must be clean, consistent, and easy to navigate.
    - **Accessibility:** The system should be accessible to users with disabilities, complying with relevant accessibility standards.

6. **Maintainability:**
    - The system must be designed for ease of maintenance and support, allowing for quick updates and fixes.
    - **Modularity:** The system architecture should be modular, enabling individual components to be updated without affecting the entire system.
    - **Documentation:** Comprehensive documentation must be provided to facilitate system maintenance and future enhancements.

Certainly! Here are some use cases for the bookkeeping service project:



## Use Cases for Bookkeeping Service

### Use Case 1: Record a Deposit Transaction

**Primary Actor:** User (Party)

**Goal:** To record a deposit transaction where the user deposits an amount in Euros to the counterparty.

**Stakeholders and Interests:**
- **User (Party):** Wants to accurately record the deposit transaction.
- **Counterparty:** Needs to have the transaction reflected in their account.

**Preconditions:**
- The user is logged into the system.
- The user has sufficient permissions to record transactions.

**Main Success Scenario:**
1. The user selects the option to record a new transaction.
2. The user chooses 'Deposit' as the transaction type.
3. The user enters the amount in Euros, the counterparty's details, and the transaction date and time.
4. The system validates the information and records the transaction.
5. The system updates the balances of both the user and the counterparty accordingly.

**Extensions:**
- 4a. If the system detects invalid data:
    - The system prompts the user to correct the information.
    - The user makes the necessary corrections and resubmits.

**Postconditions:**
- The deposit transaction is successfully recorded and reflected in the system.



### Use Case 2: Retrieve Transaction History

**Primary Actor:** User

**Goal:** To retrieve the transaction history for a specified entity or asset.

**Stakeholders and Interests:**
- **User:** Wants to view the detailed history of transactions for auditing or review purposes.

**Preconditions:**
- The user is logged into the system.
- The user has sufficient permissions to access transaction history.

**Main Success Scenario:**
1. The user navigates to the transaction history section.
2. The user specifies the entity or asset for which the history is to be retrieved.
3. The system retrieves and displays a list of all transactions involving the specified entity or asset.

**Extensions:**
- 3a. If no transactions are found:
    - The system informs the user that there are no transactions to display.

**Postconditions:**
- The user is able to view and analyze the transaction history.



### Use Case 3: Buy an Asset

**Primary Actor:** User (Party)

**Goal:** To record a 'Buy' transaction where the user purchases an asset from the counterparty.

**Stakeholders and Interests:**
- **User (Party):** Wants to accurately record the purchase of an asset.
- **Counterparty:** Needs to have the transaction reflected in their account.

**Preconditions:**
- The user is logged into the system.
- The user has sufficient permissions to record transactions.

**Main Success Scenario:**
1. The user selects the option to record a new transaction.
2. The user chooses 'Buy' as the transaction type.
3. The user enters the asset details, the amount in Euros, the counterparty's details, and the transaction date and time.
4. The system validates the information and records the transaction.
5. The system updates the user's balance and asset ownership, and the counterparty's balance accordingly.

**Extensions:**
- 4a. If the system detects invalid data:
    - The system prompts the user to correct the information.
    - The user makes the necessary corrections and resubmits.

**Postconditions:**
- The 'Buy' transaction is successfully recorded, and the asset ownership is updated in the system.

