select * from items;
select * from users;
select * from wishlist;

INSERT INTO items (user_id, description, created_at, modified_at) VALUES('2','Oneplus 4', NOW(),NOW());

INSERT INTO users (name, username, password, hire_date, created_at, modified_at) VALUES('Jeff Hedfors','jhedfors', 'lajsdlfj', '2016-01-01',NOW(),NOW());

SELECT * FROM users WHERE username = 'jhedfors';


SELECT quote_id from favorites
where user_id = 1;

--  in wishlist	
SELECT items.id as item_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 1;

--  not in  wishlist	
SELECT items.id as item_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE NOT items.id in
(SELECT items.id from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 1);


-- in wishlist	incl items added
SELECT items.id as item_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 2 OR items.user_id = 2;

--  not in  wishlist	
SELECT items.id as item_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE NOT items.id in
(SELECT items.id from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 2 OR items.user_id = 2); 

-- in wishlist	incl items added
SELECT items.id as item_id, users.id as user_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 1 OR items.user_id = 1;

--  not in  wishlist	
SELECT items.id as item_id, users.id as user_id, users.first_name as first_name, description, items.created_at as date_added from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE NOT items.id in
(SELECT items.id from items
LEFT JOIN users ON users.id = items.user_id
LEFT JOIN wishlist on wishlist.item_id = items.id
WHERE wishlist.user_id = 1 OR items.user_id = 1); 





select * from wishlist;

DELETE FROM wishlist WHERE item_id= 16;

select * from items;

DELETE FROM items WHERE item_id= 16;


 -- subscribers
SELECT users.first_name as first_name, items.description as item_description from wishlist
			LEFT JOIN users on users.id = wishlist.user_id
			LEFT JOIN items on items.id = wishlist.item_id
			WHERE item_id = 2;
 -- add favorite
insert into wishlist (user_id, item_id) VALUES (2,1);

 -- delete
 DELETE from wishlist WHERE user_id = 2 AND item_id = 2;

 



SELECT * FROM trips
left join users
on users.id = trip_creator_id
where not trips.id in (SELECT trips.id FROM trips
left JOIN user_trips
ON user_trips.trips_id = trips.id
left JOIN users
ON user_trips.users_id = users.id
where users.id = 1);




SELECT quotes.id as quote_id, quotes.user_id, favorites. id as favorite_id, users.alias as alias, speaker, quote, quotes.created_at  from quotes
			LEFT JOIN users ON users.id = quotes.user_id
			LEFT JOIN favorites on favorites.quote_id = quotes.id