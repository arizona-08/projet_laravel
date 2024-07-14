**FlexiFleet**

FlexiFleet is a fleet management system designed for companies that need to manage their fleet of vehicles. The application offers an intuitive interface for administrators, order managers, agency managers, supplier managers, and car renters, each with specific permissions and roles.

**Table of Contents**
- Features
- Roles
- Installation
- Usage
- Contributing
- License

**Features**
- Dashboard: View comprehensive statistics on the fleet.
- Vehicle Management: CRUD operations for vehicles.
- Supplier Management: CRUD operations for suppliers.
- Agency Management: CRUD operations for agencies.
- Order Management: CRUD operations for orders.
- Role-Based Access Control: Different roles with specific access restrictions.

**Roles**
- Admin: Full access to all functionalities.
- Order Manager: Manage orders and view related information.
- Agency Manager: Manage agency-specific data.
- Supplier Manager: Manage suppliers and related data.
- Car Renter: View and interact with available vehicles.

**Installation**
To get a local copy up and running, follow these simple steps:

**Steps**
1. Clone the repository:
```sh
git clone https://github.com/yourusername/flexifleet.git
```
2. Navigate to the project directory:
```sh
cd flexifleet
```
3. Copy the example env file and configure the environment variables:
```sh
cp .env.example .env
```
4. Install Laravel Sail:
```sh
composer require laravel/sail --dev
```
5. Start the application:
```sh
docker compose up 
npm run dev
```
6. Run the database migrations and seeders:
```sh
./vendor/bin/sail artisan migrate --seed
```

**Usage**
Once the application is running, you can access it at http://localhost. Log in with the setup.md

**Contributing**
Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/AmazingFeature)
3. Commit your Changes (git commit -m 'Add some AmazingFeature')
4. Push to the Branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

