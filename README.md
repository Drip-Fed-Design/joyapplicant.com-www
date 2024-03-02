# JoyApplicant

## Our Goal

Ensure a joyful experience when applying for jobs & careers

Imagine a job and careers site that gives YOU, the applicant, the best job or career application experience possible. That is our mission at JoyApplicant: prioritise the applicant while they apply for a new job or the next step in their career. It matters!

## Stripe

Customer Portal Link: URL
Customer Payment Link: URL

## Validation Engine

Code validation is build using the most awesome validation engine ever created for PHP, [Respect\Validation](https://github.com/Respect/Validation).

## URL Structure

For jobs;
`https://jobapplicant/job/digital-designer/london/apple-inc/[COMPANY-ID]/[JOB-ID]/`

## SQL

```
CREATE TABLE joyUsers (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `type` tinytext,
  `password` varchar(255) NOT NULL,
  `verified_email` tinyint(1) NOT NULL DEFAULT '0',
  `verify_email_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
);

CREATE TABLE joyCompanies (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `telephone` VARCHAR(20),
    `name` VARCHAR(255) NOT NULL,
    `logo` TEXT,
    `country` VARCHAR(100),
    `postcodezip` VARCHAR(100),
    `category` VARCHAR(100),
    `established` DATE,
    `employees` INT,
    `description` TEXT,
    `about` TEXT,
    `culture` TEXT,
    `admins` TEXT,
    `created_by` INT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE joyCompaniesAlias (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `company` INT NOT NULL UNIQUE,
    `visibility` INT NULL DEFAULT NULL,
    `alias` VARCHAR(100),
    `created_by` INT NOT NULL
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE joyCompaniesReview (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user` INT,
    `company` INT,
    `stars` INT,
    `review` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE joyJobPosts (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(100),
    `country` VARCHAR(100),
    `postcodezip` VARCHAR(100),
    `type` VARCHAR(100),
    `shift` VARCHAR(100),
    `currency` VARCHAR(3) NULL DEFAULT 'GBP',
    `salary` INT,
    `teaser` VARCHAR(255),
    `keywords` TEXT,
    `description` TEXT,
    `date_opening` timestamp NULL,
    `date_closing` timestamp NULL,
    `company` INT NOT NULL,
    `created_by` INT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE joyJobStats (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `views_total` INT,
    `views_unique` INT,
    `applicants` INT,
    `saved` INT,
    `weekly_logs` TEXT,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE joyUsersAlias (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user` INT NOT NULL UNIQUE,
    `visibility` INT NULL DEFAULT NULL,
    `alias` VARCHAR(100),
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE joyUsersDetails (
  `user` INT NOT NULL UNIQUE PRIMARY KEY,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `country` VARCHAR(100) NOT NULL,
  `postcodezip` VARCHAR(100) NOT NULL,
  `find_us` VARCHAR(100) NOT NULL
);

CREATE TABLE joyUsersExperience (
  `id` INT NOT NULL,
  `user` INT NOT NULL,
  `experience` INT NOT NULL,
  `role` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `company` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `working_role` INT DEFAULT NULL,
  `start_date` DATE DEFAULT NULL,
  `end_date` DATE DEFAULT NULL,
  `description` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)

```

## Dummy Data

```
INSERT INTO joyCompanies (email, telephone, name, logo, city, country, category, established, employees, description, about, culture, admins, created_by) VALUES
('contact@bluewidgets.com', '123-456-7890', 'Blue Widgets Inc.', 'https://picsum.photos/200/200/?blur=5', 'Springfield', 'USA', 'Manufacturing', '2001-05-20', 150, 'Leading manufacturer of blue widgets, known for innovative design and high-quality products.', 'Founded in 2001, Blue Widgets Inc. has consistently been at the forefront of widget technology.', 'A culture of innovation and excellence, with a focus on employee well-being and environmental sustainability.', '["John Doe", "Jane Smith"]', 1),
('info@greensolar.co', '987-654-3210', 'Green Solar Solutions', 'https://picsum.photos/200/200/?blur=5', 'Sunnyvale', 'Australia', 'Energy', '2010-08-15', 75, 'Provider of sustainable solar energy solutions for residential and commercial applications.', 'Green Solar Solutions has been a pioneer in renewable energy since 2010, committed to reducing carbon footprint.', 'Committed to sustainability, diversity, and community engagement, fostering a collaborative and inclusive environment.', '["Alice Johnson", "Bob Lee"]', 2),
('support@techinnovate.net', '555-1234-5678', 'Tech Innovate', 'https://picsum.photos/200/200/?blur=5', 'Tech City', 'UK', 'Technology', '2015-03-10', 200, 'A technology company specializing in innovative software solutions for businesses.', 'Tech Innovate has rapidly grown since its inception in 2015, known for its cutting-edge technology and creative solutions.', 'Dynamic and creative culture with a strong emphasis on continuous learning and employee growth.', '["Emily Turner", "David Brown"]', 3),
('info@oceanbluefishing.com', '321-555-0192', 'Ocean Blue Fishing Co.', 'https://picsum.photos/200/200/?blur=5', 'Harbor Town', 'USA', 'Fishing', '1998-04-15', 120, 'A leading company in sustainable fishing practices.', 'Dedicated to preserving marine life while providing high-quality seafood.', 'A culture of environmental stewardship and community engagement.', '["John Fisher", "Emma Tide"]', 1),
('contact@peakadventures.com', '459-123-4567', 'Peak Adventures', 'https://picsum.photos/200/200/?blur=5', 'Mountain View', 'Canada', 'Tourism', '2003-06-20', 85, 'Specializes in guided mountain treks and adventure tours.', 'Committed to offering thrilling and safe adventure experiences.', 'Focus on team spirit and respect for nature.', '["Alice Peak", "David Cliff"]', 2),
('support@techfrontier.net', '800-234-5678', 'Tech Frontier', 'https://picsum.photos/200/200/?blur=5', 'Innovate City', 'UK', 'Technology', '2012-09-12', 300, 'Innovator in cutting-edge technology solutions.', 'Aiming to drive change through technology.', 'Emphasizes innovation, creativity, and continuous learning.', '["Emily Cortex", "Ryan Byte"]', 3),
('sales@greenearthgardens.com', '212-555-7890', 'Green Earth Gardens', 'https://picsum.photos/200/200/?blur=5', 'Greenfield', 'Australia', 'Agriculture', '2007-11-01', 50, 'Organic farming and sustainable agriculture practices.', 'Dedicated to producing organic, eco-friendly products.', 'Supports local communities, promotes organic living.', '["Sarah Green", "Mark Earthman"]', 4),
('hello@artecho.com', '543-999-8080', 'Artecho', 'https://picsum.photos/200/200/?blur=5', 'Canvas City', 'Spain', 'Art & Technology', '2018-02-15', 75, 'Combines art and technology to create unique digital experiences.', 'Bridging the gap between art and digital technology.', 'Fosters creativity and artistic expression in a tech-driven world.', '["Mia Artista", "Leo Tech"]', 5),
('inquiry@brightfutureschools.edu', '606-555-0147', 'Bright Future Schools', 'https://picsum.photos/200/200/?blur=5', 'Education Bay', 'USA', 'Education', '2005-08-23', 150, 'Educational institution focused on innovative teaching methods.', 'Providing a supportive and dynamic learning environment.', 'Encourages intellectual growth and personal development.', '["Lisa Wise", "Tom Learn"]', 6),
('service@globalconnect.com', '777-321-6549', 'Global Connect', 'https://picsum.photos/200/200/?blur=5', 'Link City', 'Japan', 'Telecommunications', '2001-05-30', 500, 'Leader in telecommunications, connecting people globally.', 'Striving to bridge communication gaps worldwide.', 'Cultivates diversity, inclusion, and global outreach.', '["Haruto Link", "Anna Speak"]', 7),
('info@cleancitysolutions.org', '403-555-1212', 'Clean City Solutions', 'https://picsum.photos/200/200/?blur=5', 'Eco Town', 'Netherlands', 'Environmental Services', '2010-03-14', 65, 'Providing eco-friendly solutions for urban environments.', 'Dedicated to making cities cleaner and more sustainable.', 'Values innovation, community involvement, and eco-awareness.', '["Eva Green", "Noah Urban"]', 8),
('contact@oceanviewtech.com', '555-0101', 'OceanView Technology', 'https://picsum.photos/200/200/?blur=5', 'Bayville', 'USA', 'Technology', '2005-04-15', 300, 'Innovative tech solutions provider, specializing in marine technology.', 'Founded in 2005, OceanView Technology has been a leader in developing cutting-edge marine technology solutions.', 'A culture of innovation, collaboration, and respect for the ocean.', '["John Adams", "Diane Clarke"]', 1),
('info@mountainmovers.net', '555-0202', 'Mountain Movers', 'https://picsum.photos/200/200/?blur=5', 'Highland', 'Canada', 'Construction', '1998-08-20', 150, 'Leading construction firm known for eco-friendly and sustainable building practices.', 'Since 1998, Mountain Movers has been setting the standard in sustainable construction.', 'Committed to sustainability, safety, and community involvement.', '["Michael Johnson", "Emma White"]', 2),
('support@brightfutureschools.edu', '555-0303', 'Bright Future Schools', 'https://picsum.photos/200/200/?blur=5', 'Sunrise', 'UK', 'Education', '2010-09-01', 100, 'A network of schools dedicated to innovative education and holistic development.', 'Bright Future Schools was established in 2010 with a vision to transform education.', 'A nurturing and inclusive environment, fostering creativity and growth.', '["Alice Martin", "Richard Lee"]', 3),
('sales@greengardens.org', '555-0404', 'Green Gardens', 'https://picsum.photos/200/200/?blur=5', 'Meadowville', 'Australia', 'Agriculture', '2012-03-14', 80, 'Organic farming and sustainable agricultural practices.', 'Green Gardens has been a pioneer in organic farming since 2012, promoting sustainable agriculture.', 'Eco-friendly, community-driven, and innovation in agriculture.', '["Lucy Smith", "David Wright"]', 4),
('service@citycyclegear.com', '555-0505', 'City Cycle Gear', 'https://picsum.photos/200/200/?blur=5', 'Metroville', 'Germany', 'Retail', '2015-06-30', 50, 'Premium cycling gear and accessories for urban cyclists.', 'City Cycle Gear, founded in 2015, offers high-quality cycling gear for the modern city rider.', 'A vibrant and active culture, promoting urban cycling and sustainability.', '["Anna Brown", "Mark Davis"]', 5),
('inquiry@crystalclearwaters.com', '555-0606', 'Crystal Clear Waters', 'https://picsum.photos/200/200/?blur=5', 'Lakeside', 'Finland', 'Environmental Services', '2000-07-22', 120, 'Water purification and environmental services, dedicated to preserving natural water sources.', 'Crystal Clear Waters, established in 2000, is at the forefront of water purification technology.', 'A commitment to environmental stewardship and community engagement.', '["Erica Storm", "Oliver Green"]', 6),
('help@skyhighaviation.co', '555-0707', 'Sky High Aviation', 'https://picsum.photos/200/200/?blur=5', 'Cloud City', 'Brazil', 'Aviation', '1995-11-17', 200, 'Leading aviation company with a focus on innovative aircraft design.', 'Sky High Aviation, since 1995, has been a pioneer in the aviation industry.', 'Dynamic, forward-thinking, and dedicated to safety and excellence.', '["James King", "Sophia Hill"]', 7),
('contact@digitaldreams.io', '555-0808', 'Digital Dreams', 'https://picsum.photos/200/200/?blur=5', 'Silicon Valley', 'USA', 'Software', '2018-01-05', 250, 'Software development company specializing in virtual reality and AI.', 'Founded in 2018, Digital Dreams is at the cutting edge of VR and AI technology.', 'Creative, collaborative, and technologically driven culture.', '["Nathan Ford", "Mia Wallace"]', 8);

INSERT INTO joyJobPosts (title, city, country, type, shift, salary, teaser, description, created_by) VALUES
('Manufacturing Engineer', 'Springfield', 'USA', 'Full-time', 'Day', 80000, 'Seeking an experienced Manufacturing Engineer to join our innovative team.', 'Responsible for developing and improving manufacturing processes, ensuring efficiency and quality in production.', 1),
('Product Designer', 'Springfield', 'USA', 'Part-time', 'Flexible', 60000, 'Creative Product Designer wanted to create the next generation of widgets.', 'Design and prototype new widget models, collaborate with engineering and marketing teams.', 1),
('Solar Technician', 'Sunnyvale', 'Australia', 'Full-time', 'Day', 70000, 'Join us as a Solar Technician in the rapidly growing renewable energy sector.', 'Installation and maintenance of solar panels, ensuring optimal performance and customer satisfaction.', 2),
('Sales Manager', 'Sunnyvale', 'Australia', 'Full-time', 'Day', 75000, 'Experienced Sales Manager needed to drive growth in our solar solutions division.', 'Lead sales team, develop strategies to expand market reach, manage key client relationships.', 2),
('Software Developer', 'Tech City', 'UK', 'Full-time', 'Day', 85000, 'Seeking a skilled Software Developer to contribute to exciting tech projects.', 'Develop and maintain innovative software applications, collaborate with cross-functional teams.', 3),
('Project Manager', 'Tech City', 'UK', 'Part-time', 'Flexible', 65000, 'Project Manager needed for managing cutting-edge technology projects.', 'Oversee project timelines, manage resources, ensure deliverables meet quality standards.', 3),
('Software Engineer', 'Bayville', 'USA', 'Full-time', 'Day', 90000, 'Join our dynamic tech team as a Software Engineer.', 'Develop and maintain innovative software solutions, work in a collaborative environment.', 1),
('Marine Biologist', 'Bayville', 'USA', 'Full-time', 'Day', 70000, 'OceanView Technology seeks a dedicated Marine Biologist.', 'Conduct marine research to inform our technology solutions.', 1),
('Site Supervisor', 'Highland', 'Canada', 'Full-time', 'Day', 80000, 'Experienced Site Supervisor needed for eco-friendly construction projects.', 'Oversee construction sites, ensure adherence to sustainable practices.', 2),
('Architect', 'Highland', 'Canada', 'Full-time', 'Day', 85000, 'Creative Architect to design sustainable buildings.', 'Develop architectural plans with a focus on eco-sustainability.', 2),
('Primary School Teacher', 'Sunrise', 'UK', 'Full-time', 'Day', 35000, 'Bright Future Schools looking for inspiring Primary School Teachers.', 'Teach and nurture young minds, create engaging learning experiences.', 3),
('School Counselor', 'Sunrise', 'UK', 'Part-time', 'Day', 30000, 'School Counselor to support student well-being and development.', 'Provide guidance and support to students, collaborate with educators.', 3),
('Organic Farm Manager', 'Meadowville', 'Australia', 'Full-time', 'Day', 60000, 'Green Gardens seeks an experienced Organic Farm Manager.', 'Manage organic farming operations, promote sustainable practices.', 4),
('Agricultural Scientist', 'Meadowville', 'Australia', 'Full-time', 'Day', 65000, 'Agricultural Scientist to innovate in organic farming techniques.', 'Research and develop new sustainable farming methods.', 4),
('Retail Manager', 'Metroville', 'Germany', 'Full-time', 'Day', 50000, 'City Cycle Gear looking for a dynamic Retail Manager.', 'Manage store operations, ensure excellent customer service.', 5),
('Bicycle Mechanic', 'Metroville', 'Germany', 'Full-time', 'Day', 40000, 'Skilled Bicycle Mechanic wanted for a busy urban store.', 'Provide repair and maintenance services for bicycles.', 5),
('Water Quality Technician', 'Lakeside', 'Finland', 'Full-time', 'Day', 55000, 'Join Crystal Clear Waters as a Water Quality Technician.', 'Monitor and improve water purification processes.', 6),
('Environmental Educator', 'Lakeside', 'Finland', 'Part-time', 'Day', 35000, 'Environmental Educator to raise awareness on water conservation.', 'Conduct educational programs on water preservation and environmental health.', 6),
('Aircraft Engineer', 'Cloud City', 'Brazil', 'Full-time', 'Day', 95000, 'Sky High Aviation seeks an innovative Aircraft Engineer.', 'Design and develop aircraft systems, ensure safety and efficiency.', 7),
('Flight Operations Manager', 'Cloud City', 'Brazil', 'Full-time', 'Day', 90000, 'Experienced Flight Operations Manager needed.', 'Manage flight operations, oversee safety and compliance.', 7),
('VR Software Developer', 'Silicon Valley', 'USA', 'Full-time', 'Day', 110000, 'Join Digital Dreams as a VR Software Developer.', 'Create cutting-edge VR applications, collaborate with a talented team.', 8),
('AI Research Scientist', 'Silicon Valley', 'USA', 'Full-time', 'Day', 120000, 'AI Research Scientist to lead innovations at Digital Dreams.', 'Conduct AI research, develop new technologies and applications.', 8),
('Nutritionist', 'Wellness City', 'Japan', 'Full-time', 'Day', 50000, 'Hearty Health looking for a knowledgeable Nutritionist.', 'Provide dietary guidance, support health and wellness programs.', 9),
('Web Developer', 'Bayville', 'USA', 'Full-time', 'Day', 70000, 'Experienced Web Developer needed for a dynamic tech team.', 'Responsible for developing and maintaining high-quality web applications.', 1),
('Construction Supervisor', 'Highland', 'Canada', 'Full-time', 'Day', 80000, 'Seeking a skilled Construction Supervisor for large scale projects.', 'Oversee construction projects, ensure compliance with safety standards.', 2),
('Primary School Teacher', 'Sunrise', 'UK', 'Full-time', 'Day', 45000, 'Passionate Primary School Teacher wanted for innovative school.', 'Teach and inspire young minds, develop educational programs.', 3),
('Agricultural Scientist', 'Meadowville', 'Australia', 'Part-time', 'Day', 60000, 'Agricultural Scientist to lead our organic farming research.', 'Conduct research to improve sustainable farming practices.', 4),
('Retail Manager', 'Metroville', 'Germany', 'Full-time', 'Day', 55000, 'Dynamic Retail Manager to oversee our city center store.', 'Manage store operations, staff training, and customer service.', 5),
('Environmental Analyst', 'Lakeside', 'Finland', 'Full-time', 'Day', 65000, 'Environmental Analyst needed for water conservation project.', 'Analyze and report on water quality, develop conservation strategies.', 6),
('Aircraft Engineer', 'Cloud City', 'Brazil', 'Full-time', 'Day', 90000, 'Experienced Aircraft Engineer for innovative aviation projects.', 'Design and test aircraft, ensure adherence to safety regulations.', 7),
('VR Developer', 'Silicon Valley', 'USA', 'Full-time', 'Day', 85000, 'Creative VR Developer to join our cutting-edge software team.', 'Develop immersive VR experiences, collaborate with designers.', 8),
('Healthcare Consultant', 'Wellness City', 'Japan', 'Part-time', 'Day', 70000, 'Healthcare Consultant to guide our wellness initiatives.', 'Provide expert advice on health and wellness programs.', 9),
('Marketing Specialist', 'Fashion Capital', 'Italy', 'Full-time', 'Day', 60000, 'Marketing Specialist with a flair for fashion needed.', 'Develop and implement marketing strategies for fashion brands.', 10);



```
