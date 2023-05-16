
-- DELETE FROM `security`.income_visitors;
-- DELETE FROM `security`.income_cars;
-- DELETE FROM `security`.visitors;
-- DELETE FROM `security`.cars;
-- DELETE FROM `security`.car_models;
-- DELETE FROM `security`.employees;
-- DELETE FROM `security`.positions;
-- DELETE FROM `security`.cards;
-- DELETE FROM `security`.card_categories;
-- DELETE FROM `security`.visitor_categories;
-- DELETE FROM `security`.firms;



-- должность сотрудников
INSERT INTO `security`.positions(position)
SELECT DISTINCT (`position`) 
FROM security_old.employees
WHERE `position` != 'NULL';

-- сотрудники
insert `security`.employees (name, last_name, middle_name, position_id)
select p.name, p.surname, p.patronymic, pos.id 
from security_old.employees p
left join `security`.positions pos on p.position = pos.position;

DELETE `security`.employees
FROM  `security`.employees
LEFT OUTER JOIN 
	(SELECT MAX(`id`) AS `id`, `last_name`, `name` FROM `security`.employees GROUP BY `last_name`, `name`) AS `tmp` 
ON `security`.employees.`id` = `tmp`.`id`  
where `tmp`.`id` IS null;

-- категории карт
INSERT into `security`.card_categories(title, description)
select p.name, p.description 
from security_old.cardcategories p;

-- карты доступа
INSERT `security`.cards (number, issued, card_category_id)
SELECT card.`number`, card.status,
	(SELECT id from `security`.card_categories n where n.title = c.name)
from security_old.cards card
left join security_old.cardcategories c on card.cardcategory_id = c.id;

-- категории посетителей
INSERT into `security`.visitor_categories(title)
select p.description
from security_old.categories p;

-- фирмы
INSERT into `security`.firms (title)
select DISTINCT `name`
from security_old.firms;

-- марки авто
INSERT into `security`.car_models (title)
select DISTINCT model.model
from security_old.cars model;

-- автомобили
INSERT INTO `security`.cars (reg_number, model_id)
SELECT DISTINCT o.number, m.id
FROM security_old.cars o
join `security`.car_models as m on o.model = m.title;

DELETE FROM `security`.cars
WHERE id NOT IN (
	SELECT *
	FROM (
		SELECT MAX(n.id) 
		from `security`.cars n
		GROUP by n.reg_number
	) 
x);

-- посетители
INSERT INTO `security`.visitors (car_id, firm_id, position_id, name, last_name, middle_name, phone)
SELECT 
	(SELECT id from `security`.cars c WHERE c.reg_number = car.`number`),
	(SELECT id from `security`.firms f WHERE f.title = firm.name), 
	(SELECT id from `security`.positions p WHERE p.`position` = visit.`position`),
	visit.name, 
	visit.surname , 
	visit.patronymic, 
	REPLACE (visit.phone, '-', NULL)
FROM security_old.visitors visit
LEFT JOIN security_old.firms firm ON firm.id = visit.firm_id
LEFT JOIN security_old.cars car ON car.id = visit.car_id;

-- посетители пешком
INSERT into `security`.income_visitors (in_time, out_time, visitor_id, security_id, employee_id, card_id, visitor_category_id)
select
	TIMESTAMP(curr.currentdate, incom.in_time),
	TIMESTAMP(curr.currentdate, incom.out_time),
	(SELECT id FROM `security`.visitors v WHERE v.name = visit.name AND v.last_name = visit.surname), 
    1,   -- security_id, 
	(SELECT id FROM `security`.employees e WHERE e.name = empl.name AND e.last_name = empl.surname),
	(SELECT id FROM `security`.cards c WHERE c.`number` = card.`number`),
	(SELECT id FROM `security`.visitor_categories vc WHERE vc.title = cat.description)
FROM security_old.incomevisitors incom
LEFT JOIN security_old.visitors visit ON visit.id = incom.visitor_id
LEFT JOIN security_old.employees empl ON empl.id = incom.employee_id
LEFT JOIN security_old.currentdates curr ON curr.id = incom.currentdate_id
LEFT join security_old.cards card ON card.id = incom.card_id
LEFT JOIN security_old.categories cat ON visit.id = cat.id ;

-- поcетители на авто
INSERT into `security`.income_cars (in_time, out_time, visitor_id, security_id, employee_id, visitor_category_id)
SELECT
	TIMESTAMP(c.currentdate, i.in_time),
	TIMESTAMP(c.currentdate, i.out_time),
	(SELECT id FROM `security`.visitors v2 WHERE v2.name = v.name AND v2.last_name = v.surname),
	1,   -- security_id,
	(SELECT id FROM `security`.employees e2 WHERE e2.name = e.name AND e2.last_name = e.surname),
	(SELECT id FROM `security`.visitor_categories vc WHERE vc.title = c2.description)
FROM security_old.incomecars i 
LEFT join security_old.visitors v on v.id = i.visitor_id 
LEFT JOIN security_old.employees e on e.id = i.employee_id
LEFT JOIN security_old.currentdates c on c.id = i.currentdate_id
LEFT JOIN security_old.categories c2 on c2.id = v.category_id;

