--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: e_billtypes; Type: TYPE; Schema: public; Owner: drake
--

CREATE TYPE e_billtypes AS ENUM (
    '0',
    '1',
    '2',
    '3',
    '4',
    '5'
);


ALTER TYPE e_billtypes OWNER TO drake;

--
-- Name: e_fueltypes; Type: TYPE; Schema: public; Owner: drake
--

CREATE TYPE e_fueltypes AS ENUM (
    'LPG',
    'Benzyna',
    'Diesel'
);


ALTER TYPE e_fueltypes OWNER TO drake;

--
-- Name: e_parttypes; Type: TYPE; Schema: public; Owner: drake
--

CREATE TYPE e_parttypes AS ENUM (
    '0',
    '1',
    '2',
    '3',
    '4',
    '5'
);


ALTER TYPE e_parttypes OWNER TO drake;

--
-- Name: e_servicetypes; Type: TYPE; Schema: public; Owner: drake
--

CREATE TYPE e_servicetypes AS ENUM (
    '0',
    '1',
    '2',
    '3',
    '4'
);


ALTER TYPE e_servicetypes OWNER TO drake;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: bill; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE bill (
    id integer NOT NULL,
    date timestamp without time zone DEFAULT ('now'::text)::date NOT NULL,
    photo character varying,
    amount numeric,
    vehicle_id integer,
    type e_billtypes
);


ALTER TABLE bill OWNER TO drake;

--
-- Name: bill_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE bill_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bill_id_seq OWNER TO drake;

--
-- Name: bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE bill_id_seq OWNED BY bill.id;


--
-- Name: garage; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE garage (
    id integer NOT NULL,
    capacity integer DEFAULT 1 NOT NULL,
    used_spots integer DEFAULT 0 NOT NULL,
    city character varying DEFAULT 'Bialystok'::character varying,
    address character varying,
    house_number character varying,
    postal_code character varying DEFAULT '15-365'::character varying NOT NULL
);


ALTER TABLE garage OWNER TO drake;

--
-- Name: garage_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE garage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE garage_id_seq OWNER TO drake;

--
-- Name: garage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE garage_id_seq OWNED BY garage.id;


--
-- Name: insurance; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE insurance (
    id integer NOT NULL,
    company character varying,
    startson date DEFAULT ('now'::text)::date,
    endson date DEFAULT ('now'::text)::date,
    price integer,
    pricenextyear integer,
    valid integer DEFAULT 0,
    insurancenumber character varying DEFAULT 0,
    vehicleid integer
);


ALTER TABLE insurance OWNER TO drake;

--
-- Name: insurance_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE insurance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insurance_id_seq OWNER TO drake;

--
-- Name: insurance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE insurance_id_seq OWNED BY insurance.id;


--
-- Name: insurance_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE insurance_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insurance_id_seq2 OWNER TO drake;

--
-- Name: owner; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE owner (
    id integer NOT NULL,
    first_name character varying NOT NULL,
    last_name character varying NOT NULL,
    phone integer,
    city character varying DEFAULT 'Bialystok'::character varying,
    postal_code character varying DEFAULT '15-365'::character varying,
    adress character varying,
    home_number character varying
);


ALTER TABLE owner OWNER TO drake;

--
-- Name: owner_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE owner_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE owner_id_seq OWNER TO drake;

--
-- Name: owner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE owner_id_seq OWNED BY owner.id;


--
-- Name: part; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE part (
    id integer NOT NULL,
    name character varying NOT NULL,
    price numeric,
    type e_parttypes
);


ALTER TABLE part OWNER TO drake;

--
-- Name: refuel; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE refuel (
    id integer NOT NULL,
    type e_fueltypes,
    amount double precision,
    cost double precision,
    vehicle integer,
    date date DEFAULT now()
);


ALTER TABLE refuel OWNER TO drake;

--
-- Name: refuel_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE refuel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE refuel_id_seq OWNER TO drake;

--
-- Name: refuel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE refuel_id_seq OWNED BY refuel.id;


--
-- Name: refuel_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE refuel_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE refuel_id_seq2 OWNER TO drake;

--
-- Name: rental; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE rental (
    id integer NOT NULL,
    start_date timestamp without time zone DEFAULT ('now'::text)::date NOT NULL,
    end_date timestamp without time zone DEFAULT ('now'::text)::date NOT NULL,
    price_daily numeric DEFAULT 50 NOT NULL,
    price_total numeric NOT NULL,
    vehicle_id integer NOT NULL
);


ALTER TABLE rental OWNER TO drake;

--
-- Name: rental_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE rental_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rental_id_seq OWNER TO drake;

--
-- Name: rental_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE rental_id_seq OWNED BY rental.id;


--
-- Name: service; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE service (
    id integer NOT NULL,
    title character varying,
    description character varying,
    date date DEFAULT ('now'::text)::date,
    mileage integer,
    cost double precision,
    vehicle integer,
    service_shop_id integer DEFAULT 0,
    type e_servicetypes DEFAULT '1'::e_servicetypes
);


ALTER TABLE service OWNER TO drake;

--
-- Name: repair_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE repair_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE repair_id_seq OWNER TO drake;

--
-- Name: repair_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE repair_id_seq OWNED BY service.id;


--
-- Name: service_parts; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE service_parts (
    service_id integer,
    part_id integer,
    id integer NOT NULL
);


ALTER TABLE service_parts OWNER TO drake;

--
-- Name: service_parts_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE service_parts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE service_parts_id_seq OWNER TO drake;

--
-- Name: service_parts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE service_parts_id_seq OWNED BY service_parts.id;


--
-- Name: service_shop; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE service_shop (
    id integer NOT NULL,
    name character varying NOT NULL,
    phone_number integer,
    city character varying,
    hours_working character varying,
    rebate numeric DEFAULT 0 NOT NULL,
    address character varying,
    house_number character varying,
    postal_code character varying
);


ALTER TABLE service_shop OWNER TO drake;

--
-- Name: service_shop_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE service_shop_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE service_shop_id_seq OWNER TO drake;

--
-- Name: service_shop_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE service_shop_id_seq OWNED BY service_shop.id;


--
-- Name: table_name_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE table_name_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE table_name_id_seq OWNER TO drake;

--
-- Name: table_name_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE table_name_id_seq OWNED BY part.id;


--
-- Name: vehicle; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE vehicle (
    id integer NOT NULL,
    type character varying,
    make character varying,
    capacity integer,
    year integer,
    insurance integer,
    photo character varying,
    rentcost integer DEFAULT 100,
    fueltype character varying DEFAULT 'Benzyna'::character varying NOT NULL,
    garage_id integer,
    owner_id integer
);


ALTER TABLE vehicle OWNER TO drake;

--
-- Name: vehicle_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE vehicle_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vehicle_id_seq OWNER TO drake;

--
-- Name: vehicle_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE vehicle_id_seq OWNED BY vehicle.id;


--
-- Name: vehicle_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE vehicle_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vehicle_id_seq2 OWNER TO drake;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY bill ALTER COLUMN id SET DEFAULT nextval('bill_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY garage ALTER COLUMN id SET DEFAULT nextval('garage_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance ALTER COLUMN id SET DEFAULT nextval('insurance_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY owner ALTER COLUMN id SET DEFAULT nextval('owner_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY part ALTER COLUMN id SET DEFAULT nextval('table_name_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel ALTER COLUMN id SET DEFAULT nextval('refuel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY rental ALTER COLUMN id SET DEFAULT nextval('rental_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service ALTER COLUMN id SET DEFAULT nextval('repair_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_parts ALTER COLUMN id SET DEFAULT nextval('service_parts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_shop ALTER COLUMN id SET DEFAULT nextval('service_shop_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle ALTER COLUMN id SET DEFAULT nextval('vehicle_id_seq'::regclass);


--
-- Data for Name: bill; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY bill (id, date, photo, amount, vehicle_id, type) FROM stdin;
6	2017-12-22 00:00:00	paragon.jpg	75	28	4
7	2017-12-15 00:00:00	paragon_fiskalny.jpg	95	30	5
\.


--
-- Name: bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('bill_id_seq', 7, true);


--
-- Data for Name: garage; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY garage (id, capacity, used_spots, city, address, house_number, postal_code) FROM stdin;
1	100	3	Białystok	Pogodna - garaże za Biedronką	1	15-365
0	100	3	Bialystok	Pod chmurką		15-365
\.


--
-- Name: garage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('garage_id_seq', 1, true);


--
-- Data for Name: insurance; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY insurance (id, company, startson, endson, price, pricenextyear, valid, insurancenumber, vehicleid) FROM stdin;
9	TUW	2016-08-08	2017-08-09	468	\N	0	34214321	29
10	Link4	2016-09-21	2017-09-22	540	\N	0	M43214321	30
7	Axa Direct	2017-05-31	2018-06-01	820	555	0	M3342314312	26
11	Link4	2017-12-04	2017-12-29	123	321	0	Tralala1234	32
8	Axa Direct	2017-10-31	2018-10-30	500	41	0	M4312432	28
\.


--
-- Name: insurance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('insurance_id_seq', 11, true);


--
-- Name: insurance_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('insurance_id_seq2', 1, false);


--
-- Data for Name: owner; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY owner (id, first_name, last_name, phone, city, postal_code, adress, home_number) FROM stdin;
2	Krzysztof	Kosiński	510472300	Białystok	15-365	Pogodna	33
1	Andrzej	Kowalski	50127631	Grajewo	19-200	Wiejska	14
\.


--
-- Name: owner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('owner_id_seq', 2, true);


--
-- Data for Name: part; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY part (id, name, price, type) FROM stdin;
5	Olej silnikowy Mobil1 10W40	99	3
6	Olej do skrzyń biegów Ravenol	134	3
7	Drążek kierowniczy SGB	94	1
8	Wycieraczki Bosch 450mm	15	0
9	Tłoki pierścieniowe pomniejszone	612	2
10	Płyn do spryskiwaczy śmierdzący	12	0
\.


--
-- Data for Name: refuel; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY refuel (id, type, amount, cost, vehicle, date) FROM stdin;
11	LPG	76	135	28	2017-07-01
13	Diesel	45	170	30	2017-07-02
10	Benzyna	630	1200	29	2017-07-01
12	Diesel	400	159.990000000000009	26	2017-07-02
14	Diesel	251	125	30	2017-11-11
15	LPG	251	231	30	2017-11-11
16	LPG	34	77	28	2017-12-17
17	Benzyna	25	123	28	2017-12-17
\.


--
-- Name: refuel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('refuel_id_seq', 17, true);


--
-- Name: refuel_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('refuel_id_seq2', 1, false);


--
-- Data for Name: rental; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY rental (id, start_date, end_date, price_daily, price_total, vehicle_id) FROM stdin;
1	2017-11-11 00:00:00	2017-11-16 00:00:00	100	600	28
2	2017-11-23 00:00:00	2017-11-30 00:00:00	100	800	28
3	2017-11-08 00:00:00	2017-11-24 00:00:00	100	1700	28
4	2017-11-08 00:00:00	2017-11-01 00:00:00	100	800	28
5	2017-11-02 00:00:00	2017-11-24 00:00:00	100	2300	28
6	2017-11-30 00:00:00	2017-11-24 00:00:00	100	700	28
7	2017-11-30 00:00:00	2017-11-29 00:00:00	100	200	28
8	2017-11-30 00:00:00	2017-11-22 00:00:00	100	900	28
9	2017-11-16 00:00:00	2017-11-02 00:00:00	100	1500	28
10	2017-11-01 00:00:00	2017-11-05 00:00:00	100	500	28
11	2017-11-13 00:00:00	2017-11-16 00:00:00	100	400	28
12	2017-11-15 00:00:00	2017-11-30 00:00:00	100	1600	28
13	2017-12-21 00:00:00	2017-12-30 00:00:00	100	1000	28
\.


--
-- Name: rental_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('rental_id_seq', 13, true);


--
-- Name: repair_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('repair_id_seq', 41, true);


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY service (id, title, description, date, mileage, cost, vehicle, service_shop_id, type) FROM stdin;
37	Silnikowy	Wymieniono stary olej, bo zrobił za duży przebieg już	2017-12-05	123456	55	28	0	1
38	Obowiązkowy	Zrobiono obowiązkowy przegląd na SKP	2017-12-08	72341	99	26	\N	0
39	Platynowe	Zmieniono świece 8 sztuk na platynowe bo słabo było	2017-12-09	12313	222	29	0	2
40	Wiele napraw	Zrobiono wiele rzeczy korzystając z wielu części, bo auto było kiepskawe	2017-12-09	99999	555	30	0	4
41	Obowiązkowy techniczny		2016-12-22	586321	99	26	\N	0
\.


--
-- Data for Name: service_parts; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY service_parts (service_id, part_id, id) FROM stdin;
\N	\N	6
\N	\N	8
\N	\N	13
\N	\N	17
\N	\N	22
\N	\N	4
\N	\N	11
\N	\N	14
\N	\N	18
\N	\N	23
\N	\N	3
\N	\N	5
\N	\N	7
\N	\N	12
\N	\N	15
\N	\N	16
\N	\N	21
\N	\N	24
37	5	26
40	6	27
40	7	28
40	8	29
40	10	30
\.


--
-- Name: service_parts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('service_parts_id_seq', 30, true);


--
-- Data for Name: service_shop; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY service_shop (id, name, phone_number, city, hours_working, rebate, address, house_number, postal_code) FROM stdin;
0	Praca wlasna	\N	Bialystok	24/7	100	\N	\N	\N
1	Auto Premio	12345678	Białystok	8-17	20	Kopernika	15	15-123
\.


--
-- Name: service_shop_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('service_shop_id_seq', 1, true);


--
-- Name: table_name_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('table_name_id_seq', 10, true);


--
-- Data for Name: vehicle; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY vehicle (id, type, make, capacity, year, insurance, photo, rentcost, fueltype, garage_id, owner_id) FROM stdin;
30	Osobowy	Mazda 6	1900	2007	10		\N	Diesel	1	1
29	Osobowy	Honda Civic	1698	2002	9		\N	LPG	0	1
26	Osobowy	Citroen C3	1400	2006	7		0	Diesel	0	\N
32	Ciezarowka	Renault Midlum	5234	2001	11	Renault_Midlum_ret.jpg	140	Diesel	1	1
28	Osobowy	Cadillac Deville	4600	2003	8		0	LPG	0	\N
\.


--
-- Name: vehicle_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('vehicle_id_seq', 34, true);


--
-- Name: vehicle_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('vehicle_id_seq2', 1, false);


--
-- Name: bill_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY bill
    ADD CONSTRAINT bill_pkey PRIMARY KEY (id);


--
-- Name: garage_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY garage
    ADD CONSTRAINT garage_pkey PRIMARY KEY (id);


--
-- Name: insurance_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance
    ADD CONSTRAINT insurance_pkey PRIMARY KEY (id);


--
-- Name: owner_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_pkey PRIMARY KEY (id);


--
-- Name: refuel_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel
    ADD CONSTRAINT refuel_pkey PRIMARY KEY (id);


--
-- Name: rental_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY rental
    ADD CONSTRAINT rental_pkey PRIMARY KEY (id);


--
-- Name: repair_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service
    ADD CONSTRAINT repair_pkey PRIMARY KEY (id);


--
-- Name: service_parts_id_pk; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_parts
    ADD CONSTRAINT service_parts_id_pk PRIMARY KEY (id);


--
-- Name: service_shop_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_shop
    ADD CONSTRAINT service_shop_pkey PRIMARY KEY (id);


--
-- Name: table_name_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY part
    ADD CONSTRAINT table_name_pkey PRIMARY KEY (id);


--
-- Name: vehicle_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_pkey PRIMARY KEY (id);


--
-- Name: bill_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX bill_id_uindex ON bill USING btree (id);


--
-- Name: garage_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX garage_id_uindex ON garage USING btree (id);


--
-- Name: insurance_insurancenumber_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX insurance_insurancenumber_uindex ON insurance USING btree (insurancenumber);


--
-- Name: owner_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX owner_id_uindex ON owner USING btree (id);


--
-- Name: rental_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX rental_id_uindex ON rental USING btree (id);


--
-- Name: service_shop_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX service_shop_id_uindex ON service_shop USING btree (id);


--
-- Name: table_name_id_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX table_name_id_uindex ON part USING btree (id);


--
-- Name: bill_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY bill
    ADD CONSTRAINT bill_vehicle_id_fk FOREIGN KEY (vehicle_id) REFERENCES vehicle(id);


--
-- Name: insurance_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance
    ADD CONSTRAINT insurance_vehicle_id_fk FOREIGN KEY (vehicleid) REFERENCES vehicle(id) ON DELETE CASCADE;


--
-- Name: refuel_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel
    ADD CONSTRAINT refuel_vehicle_id_fk FOREIGN KEY (vehicle) REFERENCES vehicle(id) ON DELETE CASCADE;


--
-- Name: rental_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY rental
    ADD CONSTRAINT rental_vehicle_id_fk FOREIGN KEY (vehicle_id) REFERENCES vehicle(id);


--
-- Name: repair_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service
    ADD CONSTRAINT repair_vehicle_id_fk FOREIGN KEY (vehicle) REFERENCES vehicle(id);


--
-- Name: service_parts_part_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_parts
    ADD CONSTRAINT service_parts_part_id_fk FOREIGN KEY (part_id) REFERENCES part(id) ON DELETE SET NULL;


--
-- Name: service_parts_service_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service_parts
    ADD CONSTRAINT service_parts_service_id_fk FOREIGN KEY (service_id) REFERENCES service(id) ON DELETE SET NULL;


--
-- Name: service_service_shop_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service
    ADD CONSTRAINT service_service_shop_id_fk FOREIGN KEY (service_shop_id) REFERENCES service_shop(id) ON DELETE SET NULL;


--
-- Name: vehicle_garage_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_garage_id_fk FOREIGN KEY (garage_id) REFERENCES garage(id);


--
-- Name: vehicle_insurance_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_insurance_id_fk FOREIGN KEY (insurance) REFERENCES insurance(id);


--
-- Name: vehicle_owner_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_owner_id_fk FOREIGN KEY (owner_id) REFERENCES owner(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

