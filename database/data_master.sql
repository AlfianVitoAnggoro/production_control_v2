/* MENAMBAHKAN KOLOM BARU PADA TABEL DATA BREAKDOWN, KOLOM AMB, MCB, WET */
/****** Object:  Table [dbo].[data_breakdown]    Script Date: 16/05/2023 11:29:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_breakdown](
	[id_breakdown] [int] IDENTITY(1,1) NOT NULL,
	[jenis_breakdown] [varchar](50) NULL,
	[proses_breakdown] [varchar](50) NULL,
	[dept_in_charge] [varchar](50) NULL,
	[perhitungan] [varchar](50) NULL,
	[status] [varchar](50) NULL,
	[AMB] [int] NULL,
	[MCB] [int] NULL,
	[WET] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_breakdown] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN KOLOM BARU PADA TABEL DATA REJECT, KOLOM AMB, MCB, WET */
/****** Object:  Table [dbo].[data_reject]    Script Date: 16/05/2023 11:29:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_reject](
	[id_reject] [int] IDENTITY(1,1) NOT NULL,
	[jenis_reject] [varchar](50) NULL,
	[kategori_reject] [varchar](100) NULL,
	[dashboard] [varchar](50) NULL,
	[AMB] [int] NULL,
	[MCB] [int] NULL,
	[WET] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_reject] PRIMARY KEY CLUSTERED 
(
	[id_reject] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* DATA PADA TABEL DATA BREAKDOWN */
SET IDENTITY_INSERT [dbo].[data_breakdown] ON 

INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (35, N'SETTING', N'PLATE CUTTING', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.410' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (36, N'SETTING', N'BRUSHING', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.450' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (37, N'SETTING', N'ENVELOPE', N'PR2', N'Linestop', NULL, 1, NULL, NULL, CAST(N'2023-03-22T20:47:38.490' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (38, N'SETTING', N'COS', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.527' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (39, N'SETTING', N'SAW', N'PR2', N'Linestop', NULL, 1, NULL, NULL, CAST(N'2023-03-22T20:47:38.567' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (40, N'SETTING', N'PUNCH HOLE', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.607' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (41, N'SETTING', N'PW', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.647' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (42, N'SETTING', N'SHORT TEST', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.687' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (43, N'SETTING', N'POLARITY TEST', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.727' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (44, N'SETTING', N'HSM', N'PR2', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:38.763' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (45, N'SETTING', N'APB', N'PR2', N'Linestop', NULL, 1, NULL, NULL, CAST(N'2023-03-22T20:47:38.807' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (46, N'SETTING', N'ALT', N'PR2', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:38.843' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (47, N'SETTING', N'DRY SEALER', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.883' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (48, N'SETTING', N'DATE CODE HEATING', N'PR2', N'Linestop', NULL, 1, NULL, NULL, CAST(N'2023-03-22T20:47:38.920' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (49, N'SETTING', N'LASER', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:38.963' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (50, N'SETTING', N'PACKING', N'PR2', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:39.000' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (51, N'EQUIPMENT', N'PROBLEM HOIST ', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.040' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (52, N'EQUIPMENT', N'PROBLEM FORKLIFT ', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.083' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (53, N'EQUIPMENT', N'PROBLEM PALET MOVER', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.123' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (54, N'EQUIPMENT', N'WRAPPING', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.163' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (55, N'EQUIPMENT', N'LIFTER', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.207' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (56, N'SLOW CYCLE', N'MAN POWER KURANG', N'PR2', N'Linestop', N'waiting', 1, 1, 1, CAST(N'2023-03-22T20:47:39.247' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (57, N'SLOW CYCLE', N'MAN POWER BARU', N'PR2', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.287' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (58, N'SLOW CYCLE', N'SETTING PARAMETER', N'PCE', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.330' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (59, N'SUPPLY MATERIAL', N'SUPPLY DARI WH TERLAMBAT', N'WH', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.370' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (60, N'SUPPLY MATERIAL', N'PERUBAHAN PLANNING', N'PPIC', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.413' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (61, N'SUPPLY MATERIAL', N'SUPPLY PLATE TERLAMBAT', N'PR1', N'Linestop', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:39.453' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (62, N'SUPPLY MATERIAL', N'MATERIAL HABIS', N'WH', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.497' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (63, N'UTILITY', N'LISTRIK PADAM', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.540' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (64, N'UTILITY', N'TEKANAN ANGIN TURUN', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.577' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (65, N'UTILITY', N'AIR PAM MATI', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.620' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (66, N'UTILITY', N'DRYER MATI', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.660' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (67, N'UTILITY', N'SCRUBBER', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.700' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (68, N'UTILITY', N'DUST COLLECTOR', N'MTN', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.740' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (69, N'QUALITY', N'PROBLEM MATERIAL', N'QUALITY', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.783' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (70, N'QUALITY', N'PROBLEM PROSES', N'QUALITY', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.823' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (71, N'QUALITY', N'REPAIR', N'QUALITY', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.867' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (72, N'QUALITY', N'REWORK PROCESS', N'QUALITY', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.907' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (73, N'QUALITY', N'TUNGGU CEK', N'QUALITY', N'Linestop', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.947' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (74, N'PLAN DOWN TIME', N'STO', N'PR2', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:39.990' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (75, N'PLAN DOWN TIME', N'TRIAL', N'ENG', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.030' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (76, N'PLAN DOWN TIME', N'DANDORY', N'MTN', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.070' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (77, N'PLAN DOWN TIME', N'PREVENTIVE MAINTENANCE', N'MTN', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.113' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (78, N'PLAN DOWN TIME', N'MAN POWER TRAINING', N'HRD', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.153' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (79, N'PLAN DOWN TIME', N'FINISHED GOOD PENUH', N'WH', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.193' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (80, N'PLAN DOWN TIME', N'DOA BERSAMA', N'PR2', N'Irreguler Plan Down Time', NULL, 1, 1, 1, CAST(N'2023-03-22T20:47:40.237' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [dept_in_charge], [perhitungan], [status], [AMB], [MCB], [WET], [created_at]) VALUES (81, N'ANDON', N'', N'', N'', NULL, 1, 1, NULL, CAST(N'2023-03-22T20:47:40.277' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_breakdown] OFF
GO
/* DATA PADA TABEL DATA REJECT */
SET IDENTITY_INSERT [dbo].[data_reject] ON 

INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (1, N'COS', N'Lug Lepas', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:12.753' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (2, N'COS', N'Strap Tipis', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:12.800' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (3, N'COS', N'Pole Patah', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:12.840' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (4, N'COS', N'Connector Crack', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:12.880' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (6, N'DROPPING', N'Cell Terbalik', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:12.967' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (7, N'PW', N'PW Flashing', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.003' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (8, N'PW', N'PW Mentah', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.047' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (9, N'PW', N'PW No Weld', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.083' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (10, N'HSM', N'Pole Tarik', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.123' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (11, N'HSM', N'Bocor Gap', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.163' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (12, N'HSM', N'Bocor Crack', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.200' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (13, N'HSM', N'Salah Cover', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.250' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (14, N'APB', N'Cacat Bakar', N'reject', 1, NULL, 1, CAST(N'2023-03-20T18:36:13.293' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (15, N'APB', N'Meledak', N'reject', 1, NULL, 1, CAST(N'2023-03-20T18:36:13.333' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (16, N'DRY SEALER', N'Battery Terbacok', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.373' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (17, N'DRY SEALER', N'Over Melting', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.410' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (18, N'LASER', N'Salah Laser', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.453' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (19, N'LASER', N'Tidak Jelas', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.493' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (20, N'VISUAL', N'Cacat Cover', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.530' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (21, N'VISUAL', N'Cacat Container', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.573' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (22, N'OTHER', N'Bocor Bushing', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.613' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (23, N'OTHER', N'Bocor Top Cover', N'reject', 1, 1, 1, CAST(N'2023-03-20T18:36:13.653' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (35, N'PW', N'Cacat Container Battery', N'reject', 1, 1, 1, CAST(N'2023-03-28T10:50:13.177' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (36, N'DRY SEALER', N'Cacat Container Battery', N'reject', 1, 1, 1, CAST(N'2023-03-28T10:50:37.490' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (37, N'LASER', N'Cacat Container ', N'reject', 1, 1, 1, CAST(N'2023-03-28T10:50:47.650' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (38, N'APB', N'Cacat Container ', N'reject', 1, NULL, 1, CAST(N'2023-03-28T10:50:59.590' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (43, N'SETTING ', N'COS Sample Battery QC', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:39:55.783' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (44, N'SETTING ', N'PW Setting Battery Tooling', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:39:58.110' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (45, N'SETTING ', N'HSM Sample Cover', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:40:02.533' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (46, N'SETTING ', N'APB Setting Battery Tooling ', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:40:08.283' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (47, N'SETTING ', N'Dry Sealer', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:40:10.970' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (48, N'SETTING ', N'LASER Setting Battery Tooling', N'adj', 1, 1, 1, CAST(N'2023-03-30T14:40:11.830' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (50, N'HSM', N'Pole Ambles', N'reject', 1, 1, 1, CAST(N'2023-04-11T09:14:41.660' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (51, N'SETTING ', N'COS Sample Battery Tooling', N'adj', 1, 1, 1, CAST(N'2023-04-13T12:59:52.287' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (52, N'SETTING ', N'APB Setting Cover dan Container', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:01:46.583' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (53, N'SETTING ', N'APB Sample Battery QC', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:02:24.830' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (54, N'SETTING ', N'HSM Sample Container', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:03:58.267' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (55, N'SETTING ', N'HSM Setting Battery Tooling', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:04:21.747' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (56, N'SETTING ', N'HSM Sample Battery QC', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:05:39.090' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (57, N'SETTING ', N'LASER Sample Cover', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:07:31.400' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (58, N'SETTING ', N'PW Sample Battery QC', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:10:55.070' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (59, N'SETTING ', N'PW Sample Produksi', N'adj', 1, 1, 1, CAST(N'2023-04-13T13:11:42.297' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (61, N'PW', N'Short', N'reject', 1, 1, 1, CAST(N'2023-04-17T08:58:10.610' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (62, N'HSM', N'Bocor Pole', N'reject', 1, 1, 1, CAST(N'2023-04-17T08:58:42.703' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (63, N'APB', N'Cacat Cover', N'reject', 1, NULL, 1, CAST(N'2023-04-17T09:02:45.123' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (64, N'COS', N'Lug Gantung', N'reject', 1, 1, 1, CAST(N'2023-05-03T14:24:11.140' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (65, N'TERE', N'Plastik Terbakar', N'reject', 1, 1, 1, CAST(N'2023-05-03T14:41:41.800' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (66, N'TERE', N'Gagal Proses', N'reject', 1, 1, 1, CAST(N'2023-05-03T14:42:01.197' AS DateTime))
INSERT [dbo].[data_reject] ([id_reject], [jenis_reject], [kategori_reject], [dashboard], [AMB], [MCB], [WET], [created_at]) VALUES (67, N'TERE', N'Container Meleleh', N'reject', 1, 1, 1, CAST(N'2023-05-03T14:42:42.757' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_reject] OFF
GO